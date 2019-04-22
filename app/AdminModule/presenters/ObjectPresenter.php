<?php

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\IObjectTypeGridFactory;
use App\Model\Repository\ObjectTypeRepository;

class ObjectPresenter extends BaseUserPresenter
{
    /** @var ObjectTypeRepository */
    private $objectTypeRepository;

    /** @var IObjectTypeGridFactory */
    private $objectTypeGridFactory;

    /**
     * ObjectPresenter constructor.
     * @param ObjectTypeRepository $objectTypeRepository
     */
    public function __construct(
        ObjectTypeRepository $objectTypeRepository,
        IObjectTypeGridFactory $objectTypeGridFactory
    )
    {
        $this->objectTypeRepository = $objectTypeRepository;
        $this->objectTypeGridFactory = $objectTypeGridFactory;

        parent::__construct();
    }

    public function actionDefault()
    {

    }

    public function actionEditType(int $id)
    {

    }

    public function actionDeleteType(int $id)
    {

    }

    public function createComponentObjectTypeGrid()
    {
        return $this->objectTypeGridFactory->create();
    }

}