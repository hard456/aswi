<?php

namespace App\AdminModule\Presenters;


use App\AdminModule\Components\ISurfaceTypeEditFormFactory;
use App\AdminModule\Components\ISurfaceTypeGridFactory;
use App\Enum\EFlashMessage;
use App\Model\Repository\SurfaceTypeRepository;

class SurfacePresenter extends BaseUserPresenter
{
    /** @var ISurfaceTypeGridFactory */
    private $surfaceTypeGridFactory;

    /** @var ISurfaceTypeEditFormFactory */
    private $surfaceTypeEditFormFactory;

    /** @var SurfaceTypeRepository */
    private $surfaceTypeRepository;

    private $typeId;

    /**
     * SurfacePresenter constructor.
     * @param ISurfaceTypeGridFactory $surfaceTypeGridFactory
     * @param ISurfaceTypeEditFormFactory $surfaceTypeEditFormFactory
     * @param SurfaceTypeRepository $surfaceTypeRepository
     */
    public function __construct(
        ISurfaceTypeGridFactory $surfaceTypeGridFactory,
        ISurfaceTypeEditFormFactory $surfaceTypeEditFormFactory,
        SurfaceTypeRepository $surfaceTypeRepository
    )
    {
        parent::__construct();

        $this->surfaceTypeGridFactory = $surfaceTypeGridFactory;
        $this->surfaceTypeEditFormFactory = $surfaceTypeEditFormFactory;
        $this->surfaceTypeRepository = $surfaceTypeRepository;
    }

    public function actionAddType()
    {

    }

    public function actionEditType(int $id)
    {
        if(!$this->surfaceTypeRepository->findRow($id))
        {
            $this->flashMessage('Surface type was not found.', EFlashMessage::ERROR);
            $this->redirect('Surface:');
        }

        $this->typeId = $id;
        $this->template->id = $id;
    }

    public function actionDeleteType(int $id)
    {
        if($this->surfaceTypeRepository->delete($id))
        {
            $this->flashMessage('Surface type was deleted.', EFlashMessage::SUCCESS);
        }
        else
        {
            $this->flashMessage('Surface type was not found.', EFlashMessage::ERROR);
        }
        $this->redirect('Surface:');
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