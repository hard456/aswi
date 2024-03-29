<?php

namespace App\AdminModule\Components;


use App\Enum\EFlashMessage;
use App\Model\Repository\SurfaceTypeRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

class SurfaceTypeEditForm extends Control
{
    /** @var SurfaceTypeRepository */
    private $surfaceTypeRepository;

    private $typeId;

    /**
     * SurfaceTypeEditForm constructor.
     * @param SurfaceTypeRepository $surfaceTypeRepository
     * @param $typeId
     */
    public function __construct($typeId, SurfaceTypeRepository $surfaceTypeRepository)
    {
        $this->surfaceTypeRepository = $surfaceTypeRepository;
        $this->typeId = $typeId;

        parent::__construct();
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/SurfaceTypeEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $form = new Form();

        $form->addText(SurfaceTypeRepository::COLUMN_SURFACE_TYPE, 'Surface Type')
            ->addRule(Form::REQUIRED, 'Field %label is required.');

        $form->addInteger(SurfaceTypeRepository::COLUMN_SORTER, 'Sorter')
            ->addRule(Form::REQUIRED, 'Field %label is required.');

        $form->addSubmit('submit', 'Save');

        $form->onValidate[] = [$this, 'formValidate'];
        $form->onSuccess[] = [$this, 'formSuccess'];

        if($this->typeId)
        {
            $form->setDefaults($this->surfaceTypeRepository->findRow($this->typeId));
        }

        return $form;
    }

    /**
     * Validace formuláře
     *
     * @param Form $form
     */
    public function formValidate(Form $form)
    {
        $values = $form->getValues();

        if (!is_int($values->sorter))
        {
            $form->addError('Sorter must be a number.');
        }
    }

    public function formSuccess(Form $form)
    {
        $result = $this->surfaceTypeRepository->save($form->getValues(true), $this->typeId);

        if ($result)
        {
            $this->presenter->flashMessage('Surface type was successfully saved.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('Surface:');
        } else
        {
            $this->presenter->flashMessage('Surface type could not be saved.', EFlashMessage::ERROR);
        }
    }
}

interface ISurfaceTypeEditFormFactory
{
    /**
     * @param $typeId
     * @return SurfaceTypeEditForm
     */
    public function create($typeId);
}