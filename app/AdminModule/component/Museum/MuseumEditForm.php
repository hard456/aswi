<?php


namespace App\AdminModule\Components;

use App\Enum\EFlashMessage;
use App\Model\Repository\MuseumRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

/**
 * Formulář pro přidávání / editaci muzeí
 *
 * @package App\AdminModule\Components
 */
class MuseumEditForm extends Control
{
    /**
     * @var Form
     */
    private $form;
    /**
     * @var int ID muzea
     */
    private $museumId;

    /**
     * @var MuseumRepository
     */
    private $museumRepository;

    public function __construct(MuseumRepository $museumRepository)
    {
        parent::__construct();

        $this->museumRepository = $museumRepository;

        $this->museumId = NULL;
        $this->form = new Form;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/MuseumEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addText(MuseumRepository::COLUMN_NAME, 'Museum')
            ->addRule(Form::REQUIRED, 'Pole %label je povinné.');
        $this->form->addText(MuseumRepository::COLUMN_PLACE, 'Place')
            ->addRule(Form::REQUIRED, 'Pole %label je povinné.');

        $this->form->addSubmit('submit', 'Save');

        $this->form->setDefaults($this->getDefaults());

        $this->form->onValidate[] = [$this, 'formValidate'];
        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

    public function formValidate(Form $form)
    {
        $values = $form->getValues();

        // Vkládáme nové muzeum - kontrola zda již neexistuje se stejným názvem
        if(empty($this->museumId))
        {
            if ($this->museumRepository->findByName($values[MuseumRepository::COLUMN_NAME])->fetch())
            {
                $form->addError('Museum with the same name already exists. Please choose another name.');
            }
        }
    }

    public function formSuccess(Form $form)
    {
        $result = $this->museumRepository->save($form->getValues(TRUE), $this->museumId);

        if ($result)
        {
            $this->presenter->flashMessage('Museum was added successfully.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('Museum:edit', ['id' => $result->{MuseumRepository::COLUMN_ID}]);
        } else
        {
            $form->addError('Museum couldn\'t be added. Please try it again later.');
        }
    }

    /**
     * Nastavení ID muzea při editaci
     *
     * @param int $museumId
     */
    public function setMuseum(int $museumId)
    {
        $this->museumId = $museumId;
    }

    /**
     * Vrací hodnoty z databáze při upravování existujícího muzea
     *
     * @return array
     */
    public function getDefaults()
    {
        $defaultValues = array();

        if (!empty($this->museumId))
        {
            $museumRow = $this->museumRepository->findRow($this->museumId);

            if ($museumRow)
            {
                $defaultValues = $museumRow->toArray();
            }
        }

        return $defaultValues;
    }
}

interface IMuseumEditFormFactory
{
    /**
     * @return MuseumEditForm
     */
    public function create();
}