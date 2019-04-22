<?php

namespace App\AdminModule\Components;


use App\Model\Repository\SurfaceTypeRepository;
use App\Utils\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;

class SurfaceTypeGrid extends DataGrid
{
    /** @var SurfaceTypeRepository */
    private $surfaceTypeRepository;

    /**
     * SurfaceTypeGrid constructor.
     * @param SurfaceTypeRepository $surfaceTypeRepository
     */
    public function __construct(SurfaceTypeRepository $surfaceTypeRepository)
    {
        $this->surfaceTypeRepository = $surfaceTypeRepository;

        parent::__construct(FALSE);

    }


    public function init()
    {
        $this->setPrimaryKey(SurfaceTypeRepository::COLUMN_ID);
        $this->setDataSource($this->surfaceTypeRepository->findAll()->order(SurfaceTypeRepository::COLUMN_SORTER));
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        $this->addColumnNumber(SurfaceTypeRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnText(SurfaceTypeRepository::COLUMN_SURFACE_TYPE, 'Surface Type');
        $this->addColumnText(SurfaceTypeRepository::COLUMN_SORTER, 'Sort Position');

        $this->addFilterText(SurfaceTypeRepository::COLUMN_SURFACE_TYPE, 'Surface Type');

        $this->addAction('edit', 'edit', 'Surface:editType', ['id' => SurfaceTypeRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'smazat', 'Surface:deleteType', ['id' => SurfaceTypeRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete surface type "%s"?', SurfaceTypeRepository::COLUMN_SURFACE_TYPE)
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');

        $this->setDefaultPerPage(20);
    }
}

interface ISurfaceTypeGridFactory
{
    /**
     * @return SurfaceTypeGrid
     */
    public function create();
}