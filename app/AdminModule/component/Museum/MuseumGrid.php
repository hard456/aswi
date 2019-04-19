<?php


namespace App\AdminModule\Components;


use App\Model\Repository\MuseumRepository;
use App\Utils\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;

/**
 * Grid pro seznam muzeí, je přístupný všem uživatelům s právy editace, proto textace v ENG
 *
 * @package App\AdminModule\Components
 */
class MuseumGrid extends DataGrid
{
    /**
     * @var MuseumRepository
     */
    private $museumRepository;

    public function __construct(MuseumRepository $museumRepository)
    {
        $this->museumRepository = $museumRepository;

        parent::__construct(FALSE);
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
        $this->setPrimaryKey(MuseumRepository::COLUMN_ID);
        $this->setDataSource($this->museumRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        // Definice sloupečků
        $this->addColumnNumber(MuseumRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnText(MuseumRepository::COLUMN_NAME, 'Museum');
        $this->addColumnText(MuseumRepository::COLUMN_PLACE, 'Place');

        // Definice filtrů
        $this->addFilterText(MuseumRepository::COLUMN_NAME, 'Museum');
        $this->addFilterText(MuseumRepository::COLUMN_PLACE, 'Place');

        // Definice akcí
        $this->addAction('edit', 'edit', 'Museum:edit', ['id' => MuseumRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'deleteMuseum!', ['id' => MuseumRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete museum %s.', MuseumRepository::COLUMN_NAME)
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface IMuseumGridFactory
{
    /**
     * @return MuseumGrid
     */
    public function create();
}