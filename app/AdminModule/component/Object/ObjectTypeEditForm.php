<?php

namespace App\AdminModule\Components;


use App\Enum\EFlashMessage;
use App\Model\Repository\ObjectTypeRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

class ObjectTypeEditForm extends Control
{
    /** @var ObjectTypeRepository */
    private $objectTypeRepository;

    private $typeId;

    /**
     * ObjectTypeEditForm constructor.
     * @param ObjectTypeRepository $objectTypeRepository
     * @param $typeId null|int
     */
    public function __construct($typeId, ObjectTypeRepository $objectTypeRepository)
    {
        $this->objectTypeRepository = $objectTypeRepository;
        $this->typeId = $typeId;

        parent::__construct();
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/ObjectTypeEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $form = new Form();

        $form->addText(ObjectTypeRepository::COLUMN_OBJECT_TYPE, 'Object Tyoe')
            ->addRule(Form::REQUIRED, 'Field %label is required.');

        $form->addSubmit('save', 'Save');

        if($this->typeId)
        {
            $form->setDefaults($this->objectTypeRepository->findRow($this->typeId));
        }

        $form->onSuccess[] = [$this, 'formSuccess'];

        return $form;
    }

    public function formSuccess(Form $form)
    {
        $result = $this->objectTypeRepository->save($form->getValues(true), $this->typeId);

        if ($result)
        {
            $this->presenter->flashMessage('Object type was successfully saved.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('Object:');
        } else
        {
            $this->presenter->flashMessage('Object Type could not be saved.', EFlashMessage::ERROR);
        }
    }
}

interface IObjectTypeEditFormFactory
{
    /**
     * @param $typeId null|int
     * @return ObjectTypeEditForm
     */
    public function create($typeId);
}