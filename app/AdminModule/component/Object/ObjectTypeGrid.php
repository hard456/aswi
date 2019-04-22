<?php

namespace App\AdminModule\Components;


use App\Model\Repository\ObjectTypeRepository;

class ObjectTypeGrid extends \App\Utils\DataGrid\DataGrid
{
    /** @var \App\Model\Repository\ObjectTypeRepository */
    private $objectTypeRepository;

    /**
     * ObjectTypeGrid constructor.
     * @param \App\Model\Repository\ObjectTypeRepository $objectTypeRepository
     * @throws \Ublaboo\DataGrid\Exception\DataGridException
     */
    public function __construct(\App\Model\Repository\ObjectTypeRepository $objectTypeRepository)
    {
        $this->objectTypeRepository = $objectTypeRepository;

        parent::__construct(FALSE);
    }


    public function init()
    {
        $this->setPrimaryKey(ObjectTypeRepository::COLUMN_ID);
        $this->setDataSource($this->objectTypeRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws \Ublaboo\DataGrid\Exception\DataGridException
     */
    public function define()
    {
        $this->addColumnText(ObjectTypeRepository::COLUMN_ID, 'Id');
        $this->addColumnText(ObjectTypeRepository::COLUMN_OBJECT_TYPE, 'Object Type');

        $this->addFilterText(ObjectTypeRepository::COLUMN_OBJECT_TYPE, 'Object Type');

        $this->addAction('edit', 'edit', 'Object:editType', ['id' => ObjectTypeRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'Object:deleteType', ['id' => ObjectTypeRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete the object type "%s".', ObjectTypeRepository::COLUMN_OBJECT_TYPE)
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface IObjectTypeGridFactory
{
    /**
     * @return ObjectTypeGrid
     */
    public function create();
}