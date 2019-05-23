<?php


namespace App\AdminModule\Components;

use App\Enum\EFlashMessage;
use App\Model\Repository\BookRepository;
use App\Model\Repository\BookTypeRepository;
use App\Model\Repository\LitReferenceRepository;
use App\Model\Repository\MuseumRepository;
use App\Model\Repository\OriginRepository;
use App\Model\Repository\TransliterationRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;
use Nette\Database\Table\ActiveRow;
use Nette\Forms\Container;

/**
 * Class TransliterationEditForm
 * @package App\AdminModule\Components
 */
class TransliterationEditForm extends Control
{

    /**
     * @var Form
     */
    private $form;
    /**
     * @var int ID transliteration
     */
    private $transliterationId;

    /**
     * @var TransliterationRepository
     */
    private $transliterationRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var MuseumRepository
     */
    private $museumRepository;
    /**
     * @var OriginRepository
     */
    private $originRepository;
    /**
     * @var BookTypeRepository
     */
    private $bookTypeRepository;
    /**
     * @var LitReferenceRepository
     */
    private $litReferenceRepository;

    /**
     * TransliterationEditForm constructor.
     * @param TransliterationRepository $transliterationRepository
     * @param BookRepository $bookRepository
     * @param MuseumRepository $museumRepository
     * @param OriginRepository $originRepository
     * @param BookTypeRepository $bookTypeRepository
     * @param LitReferenceRepository $litReferenceRepository
     */
    public function __construct(TransliterationRepository $transliterationRepository,
                                BookRepository $bookRepository,
                                MuseumRepository $museumRepository,
                                OriginRepository $originRepository,
                                BookTypeRepository $bookTypeRepository,
                                LitReferenceRepository $litReferenceRepository
    )
    {
        parent::__construct();

        $this->transliterationRepository = $transliterationRepository;
        $this->bookRepository = $bookRepository;
        $this->museumRepository = $museumRepository;

        $this->transliterationId = NULL;
        $this->form = new Form;
        $this->originRepository = $originRepository;
        $this->bookTypeRepository = $bookTypeRepository;
        $this->litReferenceRepository = $litReferenceRepository;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addSelect(TransliterationRepository::COLUMN_BOOK_ID, 'Book', $this->bookRepository->getBookAbbrevForSelect());
        $this->form->addText(TransliterationRepository::COLUMN_CHAPTER, 'Chapter');
        $this->form->addSelect(TransliterationRepository::COLUMN_MUSEUM_ID, 'Museum', $this->museumRepository->getMuseumNameForSelect());
        $this->form->addText(TransliterationRepository::COLUMN_MUSEUM_NO, 'Museum No');
        $this->form->addText(TransliterationRepository::COLUMN_REG_NO, 'Reg No');
        $this->form->addSelect(TransliterationRepository::COLUMN_ORIGIN_ID, 'Origin', $this->originRepository->getOriginsForSelect());
        $this->form->addSelect(TransliterationRepository::COLUMN_BOOK_TYPE_ID, 'Book Type', $this->bookTypeRepository->getTypesForSelect());
        $this->form->addText(TransliterationRepository::COLUMN_DATE, 'Date');
        $this->form->addText(TransliterationRepository::COLUMN_NOTE, 'Note');

        // Definice dynamických prvků
        $multiplier = $this->form->addMultiplier('references', function (Container $container)
        {
            $container->addHidden(LitReferenceRepository::COLUMN_ID);
            $container->addText(LitReferenceRepository::COLUMN_SERIES, 'Series');
            $container->addText(LitReferenceRepository::COLUMN_NUMBER, 'Number');
            $container->addText(LitReferenceRepository::COLUMN_PLATE, 'Page');
        }, 0);

        // Definice tlačítek pro přidání / odebrání řádku
        $multiplier->addCreateButton('Add')->addClass('btn btn-primary');
        $multiplier->addRemoveButton('Remove')->addClass('btn btn-danger');

        $this->form->setDefaults($this->getDefaults());

        $this->form->addSubmit('submit', 'Save');

        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

    /**
     * Zpracování editace informací o transliteraci
     *
     * @param Form $form
     */
    public function formSuccess(Form $form)
    {

        $values = $form->getValues(true);
        $references = $values['references'];

        if ($this->isAnyReferenceEmpty($references))
        {
            $this->presenter->flashMessage('Transliteration could not be saved.', EFlashMessage::ERROR);
            return;
        }

        unset($values['references']);

        $this->transliterationRepository->save($values, $this->transliterationId);

        $this->deleteRemovedReferences($references);

        foreach ($references as $item)
        {
            $item[LitReferenceRepository::COLUMN_TRANSLITERATION_ID] = $this->transliterationId;
            $this->litReferenceRepository->save($item, (int)$item[LitReferenceRepository::COLUMN_ID]);
        }

        $this->presenter->flashMessage('Transliteration was successfully saved.', EFlashMessage::SUCCESS);

    }

    /**
     * Zkontroluje jestli není nějaká refence prázná
     *
     * @param $references array referencí
     * @return bool
     */
    public function isAnyReferenceEmpty($references)
    {
        foreach ($references as $r)
        {
            if (empty($r[LitReferenceRepository::COLUMN_SERIES]) && empty($r[LitReferenceRepository::COLUMN_NUMBER])
                && empty($r[LitReferenceRepository::COLUMN_PLATE]))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Odstraní odebrané reference transliterace
     *
     * @param $newReferences array nových transliterací
     */
    public function deleteRemovedReferences($newReferences)
    {
        $references = $this->litReferenceRepository->findByTransliterationId($this->transliterationId);

        foreach ($references as $ref)
        {
            if ($this->isRemovedReference($ref, $newReferences))
            {
                $this->litReferenceRepository->delete($ref[LitReferenceRepository::COLUMN_ID]);
            }
        }

    }

    /**
     * Zkontroluje jestli je refence v poli referencí
     *
     * @param $reference ActiveRow reference ke kontrole
     * @param $newReferences array pole referencí
     * @return bool
     */
    public function isRemovedReference($reference, $newReferences)
    {
        foreach ($newReferences as $ref)
        {
            if ($ref[LitReferenceRepository::COLUMN_ID] == $reference[LitReferenceRepository::COLUMN_ID])
            {
                return false;
            }
        }
        return true;
    }

    /**
     * Nastavení ID transliterace při editaci
     *
     * @param int $transliterationId
     */
    public function setTransliteration(int $transliterationId)
    {
        $this->transliterationId = $transliterationId;
    }

    /**
     * Vrátí výchozí informace o transliteraci
     *
     * @return array
     */
    private function getDefaults()
    {
        $array = $this->transliterationRepository->findRow($this->transliterationId)->toArray();
        $references = $this->litReferenceRepository->findByTransliterationId($this->transliterationId)->fetchAll();

        foreach ($references as $activeRow)
        {
            $array['references'][] = $activeRow->toArray();
        }

        return $array;
    }

}

interface ITransliterationEditFormFactory
{

    /**
     * @return TransliterationEditForm
     */
    public function create();

}