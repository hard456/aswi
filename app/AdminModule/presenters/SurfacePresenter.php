<?php

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\ISurfaceTypeEditFormFactory;
use App\AdminModule\Components\ISurfaceTypeGridFactory;

class SurfacePresenter extends BaseAdminPresenter
{
    /** @var ISurfaceTypeGridFactory */
    private $surfaceTypeGridFactory;

    /** @var ISurfaceTypeEditFormFactory */
    private $surfaceTypeEditFormFactory;

    private $typeId;

    /**
     * SurfacePresenter constructor.
     * @param ISurfaceTypeGridFactory $surfaceTypeGridFactory
     * @param ISurfaceTypeEditFormFactory $surfaceTypeEditFormFactory
     */
    public function __construct(
        ISurfaceTypeGridFactory $surfaceTypeGridFactory,
        ISurfaceTypeEditFormFactory $surfaceTypeEditFormFactory
    )
    {
        parent::__construct();

        $this->surfaceTypeGridFactory = $surfaceTypeGridFactory;
        $this->surfaceTypeEditFormFactory = $surfaceTypeEditFormFactory;
    }

    public function actionAddType()
    {

    }

    public function actionEditType(int $id)
    {
        $this->typeId = $id;
    }

    public function actionDeleteType(int $id)
    {

    }

    public function createComponentSurfaceTypeGrid()
    {
        return $this->surfaceTypeGridFactory->create();
    }

    public function createComponentSurfaceTypeEditForm()
    {
        return $this->surfaceTypeEditFormFactory->create($this->typeId);
    }
}