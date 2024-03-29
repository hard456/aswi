<?php


namespace App\AdminModule\Components;


use App\Enum\EFlashMessage;
use App\Model\Facade\TransliterationFacade;
use App\Model\Repository\LineRepository;
use App\Model\Repository\ObjectTypeRepository;
use App\Model\Repository\SurfaceTypeRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;
use Nette\Forms\Container;
use Nette\Forms\Controls\SubmitButton;
use WebChemistry\Forms\Controls\Multiplier;

class TransliterationDataEditForm extends Control
{
    /** @var int ID transliterace */
    private $id = NULL;

    /** @var array Pole objektů a typu povrch pro strom dat transliterace */
    private $containers;

    /**
     * @var ObjectTypeRepository
     */
    private $objectTypeRepository;
    /**
     * @var SurfaceTypeRepository
     */
    private $surfaceTypeRepository;
    /**
     * @var TransliterationFacade
     */
    private $transliterationFacade;

    public function __construct(ObjectTypeRepository $objectTypeRepository,
                                SurfaceTypeRepository $surfaceTypeRepository,
                                TransliterationFacade $transliterationFacade
    )
    {
        parent::__construct();

        $this->objectTypeRepository = $objectTypeRepository;
        $this->surfaceTypeRepository = $surfaceTypeRepository;
        $this->transliterationFacade = $transliterationFacade;

        $objectTypes = $this->objectTypeRepository->fetchObjectTypes();
        $surfaceTypes = $this->surfaceTypeRepository->fetchSurfaceTypes();
        $containers = [];

        // Načtení typů objektů a typu povrchů do pole pro vykreslení v šabloně
        foreach ($objectTypes as $oId => $objectType)
        {
            $containers[$oId]['title'] = $objectType;

            foreach ($surfaceTypes as $sId => $surfaceType)
            {
                $containers[$oId][$sId] = $surfaceType;
            }
        }

        $this->containers = $containers;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationDataEditForm.latte');

        $this->template->containers = $this->containers;
        $this->template->defaults = $this->getDefaults();

        $this->template->render();
    }

    public function createComponentForm()
    {
        $form = new Form;

        $redrawCallback = function ()
        {
            $this->redrawControl('dataSnippet');
        };

        foreach ($this->containers as $name => $container)
        {
            $cont = $form->addContainer($name);

            foreach ($container as $nameMultiplier => $multiplier)
            {
                if ($nameMultiplier === 'title')
                {
                    continue;
                }

                /** @var Multiplier $multiplier */
                $multiplier = $cont->addMultiplier($nameMultiplier, function (Container $container)
                {
                    $container->addInteger(LineRepository::COLUMN_LINE_NUMBER);
                    $container->addText(LineRepository::COLUMN_TRANSLITERATION);
                    $container->addHidden(LineRepository::COLUMN_ID);
                }, 0);

                $multiplier->addCreateButton('Add line', 1, $redrawCallback);
                $multiplier->addRemoveButton('Delete', $redrawCallback);
            }
        }

        $form->setDefaults($this->getDefaults());

        $form->onSuccess[] = [$this, 'formSuccess'];
        $form->addSubmit('submit', 'Save');

        return $form;
    }

    public function formSuccess(Form $form)
    {
        $result = $this->transliterationFacade->saveTransliterationData($this->id, $form);

        // Redirect musí být, jinak se v dynamických prvcích nenačtou IDčka
        //  a vkládají se nové záznamy místo upravování stávajících
        if ($result)
        {
            $this->presenter->flashMessage('Transliteration data were edited successfully.', EFlashMessage::SUCCESS);
        } else
        {
            $this->presenter->flashMessage('Transliteration data were not edited.', EFlashMessage::ERROR);
        }
        $this->presenter->redirect('Transliteration:edit', ['id' => $this->id]);
    }

    /**
     * Nastavení ID právě upravované transliterace
     *
     * @param int $id
     */
    public function setTransliteration(int $id)
    {
        $this->id = $id;
    }

    /**
     * Vrací hodnoty formuláře při editaci
     *
     * @return array
     */
    private function getDefaults()
    {
        if (isset($this->id))
        {
            return $this->transliterationFacade->getTransliterationData($this->id);
        }

        return [];
    }
}

interface ITransliterationDataEditFormFactory
{
    /**
     * @return TransliterationDataEditForm
     */
    public function create();
}