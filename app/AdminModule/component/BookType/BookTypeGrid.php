<?php

namespace App\AdminModule\Components;

use App\Model\Repository\BookTypeRepository;
use App\Utils\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;


class BookTypeGrid extends DataGrid
{

    /**
     * @var BookTypeRepository
     */
    private $bookTypeRepository;

    /**
     * BookTypeGrid constructor.
     * @param BookTypeRepository $bookTypeRepository
     * @throws DataGridException
     */
    public function __construct(BookTypeRepository $bookTypeRepository)
    {
        $this->bookTypeRepository = $bookTypeRepository;
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
        $this->setPrimaryKey(BookTypeRepository::COLUMN_ID);
        $this->setDataSource($this->bookTypeRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        // Definice sloupečků
        $this->addColumnNumber(BookTypeRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnText(BookTypeRepository::COLUMN_BOOK_TYPE, 'Book type');


        // Definice filtrů
        $this->addFilterText(BookTypeRepository::COLUMN_BOOK_TYPE, 'Book type');

        // Definice akcí
        $this->addAction('edit', 'edit', 'BookType:edit', ['id' => BookTypeRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'deleteBookType!', ['id' => BookTypeRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete book type %s.', BookTypeRepository::COLUMN_BOOK_TYPE)
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface IBookTypeGridFactory
{
    /**
     * @return BookTypeGrid
     */
    public function create();
}