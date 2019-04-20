<?php

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\ISurfaceTypeGridFactory;

class SurfacePresenter extends BaseAdminPresenter
{
    /** @var ISurfaceTypeGridFactory */
    private $surfaceTypeGridFactory;

    private $typeId;

    /**
     * SurfacePresenter constructor.
     * @param ISurfaceTypeGridFactory $surfaceTypeGridFactory
     */
    public function __construct(ISurfaceTypeGridFactory $surfaceTypeGridFactory)
    {
        parent::__construct();

        $this->surfaceTypeGridFactory = $surfaceTypeGridFactory;
    }

    public function actionAddType()
    {

    }

    public function actionEditType($id)
    {

    }

    public function actionDeleteType($id)
    {

    }

    public function createComponentSurfaceTypeGrid()
    {
        return $this->surfaceTypeGridFactory->create();
    }
}