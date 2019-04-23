<?php


namespace App\AdminModule\Components;


use App\Model\Repository\OriginRepository;
use App\Utils\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;

class OriginGrid extends DataGrid
{
    /**
     * @var OriginRepository
     */
    private $originRepository;

    public function __construct(OriginRepository $originRepository)
    {
        $this->originRepository = $originRepository;

        parent::__construct();
    }

    /**
     * Abstraktní metoda, slouží k nastavení primárního klíče a nastavení datasource
     *  1. $this->setPrimaryKey();
     *  2. $this->setDataSource();
     *
     * @throws DataGridException
     */
    public function init()
    {
        $this->setPrimaryKey(OriginRepository::COLUMN_ID);
        $this->setDataSource($this->originRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        // Definice sloupečků
        $this->addColumnNumber(OriginRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnText(OriginRepository::COLUMN_ORIGIN, 'Origin');
        $this->addColumnText(OriginRepository::COLUMN_OLD_NAME, 'Old Name');

        // Definice filtrů
        $this->addFilterText(OriginRepository::COLUMN_ORIGIN, 'Origin');
        $this->addFilterText(OriginRepository::COLUMN_OLD_NAME, 'Old Name');

        // Definice akcí
        $this->addAction('edit', 'edit', 'Origin:edit', ['id' => OriginRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'deleteOrigin!', ['id' => OriginRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete origin %s.', OriginRepository::COLUMN_ORIGIN)
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface IOriginGridFactory
{
    /**
     * @return OriginGrid
     */
    public function create();
}