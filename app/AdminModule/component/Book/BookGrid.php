<?php


namespace App\AdminModule\Components;

use App\Model\Repository\BookRepository;
use App\Utils\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;

class BookGrid extends DataGrid
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;

        parent::__construct(false);
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
        $this->setPrimaryKey(BookRepository::COLUMN_ID);
        $this->setDataSource($this->bookRepository->findAll()->order(BookRepository::COLUMN_BOOK_ABREV));
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        // Definice sloupečků
        $this->addColumnNumber(BookRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnText(BookRepository::COLUMN_BOOK_ABREV, 'Abbreviation')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_BOOK_AUTHOR, 'Author')->addAttributes(["width" => "10%"])->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_BOOK_NAME, 'Name')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_BOOK_SUBTITLE, 'Alternate name')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_BOOK_DESCRIPTION, 'Description')->addAttributes(["width" => "20%"])->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_PLACE_OF_PUB, 'Publication place')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_DATE_OF_PUB, 'Publication date')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_PAGES, 'Pages')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_VOLUME, 'Volume')->setAlign('center');
        $this->addColumnText(BookRepository::COLUMN_VOLUME_NO, 'Volume No.')->setAlign('center');

        // Definice filtrů
        $this->addFilterText(BookRepository::COLUMN_BOOK_ABREV, 'Abbreviation');
        $this->addFilterText(BookRepository::COLUMN_BOOK_AUTHOR, 'Author');
        $this->addFilterText(BookRepository::COLUMN_BOOK_NAME, 'Name');
        $this->addFilterText(BookRepository::COLUMN_BOOK_SUBTITLE, 'Alternate name');
        $this->addFilterText(BookRepository::COLUMN_BOOK_DESCRIPTION, 'Description');
        $this->addFilterText(BookRepository::COLUMN_PLACE_OF_PUB, 'Publication place');
        $this->addFilterText(BookRepository::COLUMN_DATE_OF_PUB, 'Publication date');
        $this->addFilterText(BookRepository::COLUMN_PAGES, 'Pages');
        $this->addFilterText(BookRepository::COLUMN_VOLUME, 'Volume');
        $this->addFilterText(BookRepository::COLUMN_VOLUME_NO, 'Volume No.');

        // Definice akcí
        $this->addAction('edit', 'edit', 'Book:edit', ['id' => BookRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'deleteBook!', ['id' => BookRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete book %s.', BookRepository::COLUMN_BOOK_ABREV)
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface IBookGridFactory
{
    /**
     * @return BookGrid
     */
    public function create();
}