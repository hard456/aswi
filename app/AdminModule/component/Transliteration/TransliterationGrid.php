<?php


namespace App\AdminModule\Components;


use App\Model\Repository\BookRepository;
use App\Model\Repository\BookTypeRepository;
use App\Model\Repository\MuseumRepository;
use App\Model\Repository\OriginRepository;
use App\Model\Repository\TransliterationRepository;
use App\Utils\DataGrid\DataGrid;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Ublaboo\DataGrid\Exception\DataGridException;

class TransliterationGrid extends DataGrid
{
    /**
     * @var TransliterationRepository
     */
    private $transliterationRepository;
    /**
     * @var BookRepository
     */
    private $bookRepository;
    /**
     * @var MuseumRepository
     */
    private $museumRepository;
    /**
     * @var OriginRepository
     */
    private $originRepository;
    /**
     * @var BookTypeRepository
     */
    private $bookTypeRepository;

    public function __construct(TransliterationRepository $transliterationRepository,
                                BookRepository $bookRepository,
                                MuseumRepository $museumRepository,
                                OriginRepository $originRepository,
                                BookTypeRepository $bookTypeRepository
    )
    {
        $this->transliterationRepository = $transliterationRepository;
        $this->bookRepository = $bookRepository;
        $this->museumRepository = $museumRepository;
        $this->originRepository = $originRepository;
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
        $this->setPrimaryKey(TransliterationRepository::COLUMN_ID);
        $this->setDataSource($this->transliterationRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        $bookRepository = $this->bookRepository;
        $museumRepository = $this->museumRepository;
        $originRepository = $this->originRepository;
        $bookTypeRepository = $this->bookTypeRepository;

        // ==================
        // Definice sloupečků
        // ==================
        $this->addColumnNumber(TransliterationRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnLink(TransliterationRepository::COLUMN_BOOK_ID, 'Book')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                $title = $activeRow->ref(BookRepository::TABLE_NAME, BookRepository::COLUMN_ID)->{BookRepository::COLUMN_BOOK_ABREV};
                return $this->getRendererWithLink($activeRow, $title, 'Book:edit', $activeRow->{TransliterationRepository::COLUMN_BOOK_ID});
            });
        $this->addColumnNumber(TransliterationRepository::COLUMN_CHAPTER, 'Chapter');
        $this->addColumnLink(TransliterationRepository::COLUMN_MUSEUM_ID, 'Museum')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                $title = $activeRow->ref(MuseumRepository::TABLE_NAME, MuseumRepository::COLUMN_ID)->{MuseumRepository::COLUMN_NAME};
                return $this->getRendererWithLink($activeRow, $title, 'Museum:edit', $activeRow->{TransliterationRepository::COLUMN_MUSEUM_ID});
            });
        $this->addColumnText(TransliterationRepository::COLUMN_MUSEUM_NO, 'Museum No');
        $this->addColumnLink(TransliterationRepository::COLUMN_ORIGIN_ID, 'Origin')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                $title = $activeRow->ref(OriginRepository::TABLE_NAME, OriginRepository::COLUMN_ID)->{OriginRepository::COLUMN_ORIGIN};
                return $this->getRendererWithLink($activeRow, $title, 'Origin:edit', $activeRow->{TransliterationRepository::COLUMN_ORIGIN_ID});
            });
        $this->addColumnLink(TransliterationRepository::COLUMN_BOOK_TYPE_ID, 'Book Type')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                $title = $activeRow->ref(BookTypeRepository::TABLE_NAME, BookTypeRepository::COLUMN_ID)->{BookTypeRepository::COLUMN_BOOK_TYPE};
                return $this->getRendererWithLink($activeRow, $title, 'BookType:edit', $activeRow->{TransliterationRepository::COLUMN_BOOK_TYPE_ID});
            });
        $this->addColumnText(TransliterationRepository::COLUMN_REG_NO, 'Reg No');
        $this->addColumnText(TransliterationRepository::COLUMN_DATE, 'Date');

        // ===============
        // Definice filtrů
        // ===============
        $this->addFilterText(TransliterationRepository::COLUMN_BOOK_ID, 'Book')
            ->setCondition(function (Selection $selection, $value) use ($bookRepository)
            {
                $bookIds = $bookRepository->getBooksLikeBookAbbrev($value)->fetchField(BookRepository::COLUMN_ID);
                $bookIds = $bookIds ? $bookIds : NULL;

                $selection->where(BookRepository::COLUMN_ID, $bookIds);
            });
        $this->addFilterText(TransliterationRepository::COLUMN_CHAPTER, 'Chapter');
        $this->addFilterText(TransliterationRepository::COLUMN_MUSEUM_ID, 'Museum')
            ->setCondition(function (Selection $selection, $value) use ($museumRepository)
            {
                $museumIds = $museumRepository->getMuseumsLikeName($value)->fetchField(MuseumRepository::COLUMN_ID);
                $museumIds = $museumIds ? $museumIds : NULL;

                $selection->where(MuseumRepository::COLUMN_ID, $museumIds);
            });
        $this->addFilterText(TransliterationRepository::COLUMN_MUSEUM_NO, 'Museum No');
        $this->addFilterText(TransliterationRepository::COLUMN_ORIGIN_ID, 'Origin')
            ->setCondition(function (Selection $selection, $value) use ($originRepository)
            {
                $originIds = $originRepository->getOriginsLikeName($value)->fetchField(OriginRepository::COLUMN_ID);
                $originIds = $originIds ? $originIds : NULL;

                $selection->where(OriginRepository::COLUMN_ID, $originIds);
            });
        $this->addFilterText(TransliterationRepository::COLUMN_BOOK_TYPE_ID, 'Book Type')
            ->setCondition(function (Selection $selection, $value) use ($bookTypeRepository)
            {
                $bookTypeIds = $bookTypeRepository->getBookTypesLikeType($value)->fetchField(BookTypeRepository::COLUMN_ID);
                $bookTypeIds = $bookTypeIds ? $bookTypeIds : NULL;

                $selection->where(BookTypeRepository::COLUMN_ID, $bookTypeIds);
            });
        $this->addFilterText(TransliterationRepository::COLUMN_REG_NO, 'Reg No');
        $this->addFilterText(TransliterationRepository::COLUMN_DATE, 'Date');

        // =============
        // Definice akcí
        // =============
//        $this->addAction('edit', 'edit', 'Transliteration:edit', ['id' => TransliterationRepository::COLUMN_ID])
//            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'deleteTransliteration!', ['id' => TransliterationRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete transliteration?')
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface ITransliterationGridFactory
{
    /**
     * @return TransliterationGrid
     */
    public function create();
}