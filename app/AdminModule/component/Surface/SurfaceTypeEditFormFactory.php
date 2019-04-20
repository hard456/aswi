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

        $form->addText(SurfaceTypeRepository::COLUMN_SURFACE_TYPE, 'Surface Type');
        $form->addText(SurfaceTypeRepository::COLUMN_SORTER, 'Sorter');

        $form->addSubmit('submit', 'Save');

        $form->onSuccess[] = [$this, 'formSuccess'];

        if($this->typeId)
        {
            $form->setDefaults($this->surfaceTypeRepository->findRow($this->typeId));
        }

        return $form;
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
            $this->presenter->flashMessage('Uživatele se nepodařilo upravit.', EFlashMessage::ERROR);
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