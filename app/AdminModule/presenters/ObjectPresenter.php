<?php

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\IObjectTypeEditFormFactory;
use App\AdminModule\Components\IObjectTypeGridFactory;
use App\Enum\EFlashMessage;
use App\Model\Repository\ObjectTypeRepository;

class ObjectPresenter extends BaseUserPresenter
{
    /** @var ObjectTypeRepository */
    private $objectTypeRepository;

    /** @var IObjectTypeGridFactory */
    private $objectTypeGridFactory;

    /** @var IObjectTypeEditFormFactory */
    private $objectTypeEditFormFactory;

    private $typeId;

    /**
     * ObjectPresenter constructor.
     * @param ObjectTypeRepository $objectTypeRepository
     * @param IObjectTypeGridFactory $objectTypeGridFactory
     * @param IObjectTypeEditFormFactory $objectTypeEditFormFactory
     */
    public function __construct(
        ObjectTypeRepository $objectTypeRepository,
        IObjectTypeGridFactory $objectTypeGridFactory,
        IObjectTypeEditFormFactory $objectTypeEditFormFactory
    )
    {
        $this->objectTypeRepository = $objectTypeRepository;
        $this->objectTypeGridFactory = $objectTypeGridFactory;
        $this->objectTypeEditFormFactory = $objectTypeEditFormFactory;

        parent::__construct();
    }

    public function actionDefault()
    {

    }

    public function actionEditType(int $id)
    {
        if(!$this->objectTypeRepository->findRow($id))
        {
            $this->flashMessage('Object type was not found.', EFlashMessage::ERROR);
            $this->redirect('Object:');
        }

        $this->typeId = $id;
        $this->template->id = $id;
    }

    public function actionDeleteType(int $id)
    {
        if($this->objectTypeRepository->delete($id))
        {
            $this->flashMessage('Object type was deleted.', EFlashMessage::SUCCESS);
        }
        else
        {
            $this->flashMessage('Object type was not found.', EFlashMessage::ERROR);
        }
        $this->redirect('Object:');
    }

    public function createComponentObjectTypeGrid()
    {
        return $this->objectTypeGridFactory->create();
    }

    public function createComponentObjectTypeEditForm()
    {
        return $this->objectTypeEditFormFactory->create($this->typeId);
    }
}