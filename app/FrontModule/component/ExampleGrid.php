<?php


namespace App\FrontModule\Components;


use App\Utils\DataGrid\DataGrid;
use App\Model\Repository\LineRepository;
use Ublaboo\DataGrid\Exception\DataGridException;

/**
 * Ukázkový datagrid, bude smazán při předání
 *  - všechny možnosti použití gridu lze vidět na
 *  https://gitlab.com/Fifal/dvm/blob/21afc037e3604093197e140defc05925df0b8c28/web-project/app/components/variant/VariantGrid.php
 *
 * @package App\Components
 */
class ExampleGrid extends DataGrid
{
    /** @var LineRepository */
    private $lineRepository;

    public function __construct(LineRepository $lineRepository)
    {
        $this->lineRepository = $lineRepository;

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
        $this->setPrimaryKey(LineRepository::COLUMN_ID);
        $this->setDataSource($this->lineRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        $this->addColumnNumber(LineRepository::COLUMN_ID, "ID");
        $this->addColumnText(LineRepository::COLUMN_TRANSLITERATION, "Transliterace");
        $this->addFilterText(LineRepository::COLUMN_TRANSLITERATION, "Transliterace");

        $this->addAction(LineRepository::COLUMN_TRANSLITERATION, "Smazat");
    }
}

interface IExampleGirdFactory
{
    /**
     * Funkce create je implementována již v předkovi
     *
     * @return ExampleGrid
     */
    public function create();
}