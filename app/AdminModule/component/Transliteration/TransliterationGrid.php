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

        // ==================
        // Definice sloupečků
        // ==================
        $this->addColumnNumber(TransliterationRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnLink(TransliterationRepository::COLUMN_BOOK_ID, 'Book')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                return $this->getRenderer(
                    $activeRow,
                    BookRepository::TABLE_NAME,
                    BookRepository::COLUMN_ID,
                    BookRepository::COLUMN_BOOK_ABREV,
                    TransliterationRepository::COLUMN_BOOK_ID,
                    'Book:edit'
                );
            });
        $this->addColumnNumber(TransliterationRepository::COLUMN_CHAPTER, 'Chapter');
        $this->addColumnLink(TransliterationRepository::COLUMN_MUSEUM_ID, 'Museum')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                return $this->getRenderer(
                    $activeRow,
                    MuseumRepository::TABLE_NAME,
                    MuseumRepository::COLUMN_ID,
                    MuseumRepository::COLUMN_NAME,
                    TransliterationRepository::COLUMN_MUSEUM_ID,
                    'Museum:edit'
                );
            });
        $this->addColumnText(TransliterationRepository::COLUMN_MUSEUM_NO, 'Museum No');
        $this->addColumnLink(TransliterationRepository::COLUMN_ORIGIN_ID, 'Origin')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                return $this->getRenderer(
                    $activeRow,
                    OriginRepository::TABLE_NAME,
                    OriginRepository::COLUMN_ID,
                    OriginRepository::COLUMN_ORIGIN,
                    TransliterationRepository::COLUMN_ORIGIN_ID,
                    'Origin:edit'
                );
            });
        $this->addColumnLink(TransliterationRepository::COLUMN_BOOK_TYPE_ID, 'Book Type')
            ->setRenderer(function (ActiveRow $activeRow)
            {
                return $this->getRenderer(
                    $activeRow,
                    BookTypeRepository::TABLE_NAME,
                    BookTypeRepository::COLUMN_ID,
                    BookTypeRepository::COLUMN_BOOK_TYPE,
                    TransliterationRepository::COLUMN_BOOK_TYPE_ID,
                    'BookType:edit'
                );
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
        $this->addFilterSelect(TransliterationRepository::COLUMN_ORIGIN_ID, 'Origin', $this->getOriginFilterArray());
        $this->addFilterSelect(TransliterationRepository::COLUMN_BOOK_TYPE_ID, 'Book Type', $this->getBookTypeFilterArray());
        $this->addFilterText(TransliterationRepository::COLUMN_REG_NO, 'Reg No');
        $this->addFilterText(TransliterationRepository::COLUMN_DATE, 'Date');

        // Zakázání zobrazení všech položek, protože jinak se grid sekne a nelze resetovat
        $this->setItemsPerPageList([10, 20, 50, 100], FALSE);

        // =============
        // Definice akcí
        // =============
        $this->addAction('edit', 'edit', 'Transliteration:edit', ['id' => TransliterationRepository::COLUMN_ID])
            ->setTitle('Edit');

        $this->addAction('delete', 'delete', 'deleteTransliteration!', ['id' => TransliterationRepository::COLUMN_ID])
            ->setConfirm('Do you really want to delete transliteration?')
            ->setTitle('Delete')
            ->setClass('btn btn-xs btn-danger ajax');
    }

    /**
     * Vrací pole s možnostmi pro combobox filtr místa původu
     *
     * @return array
     */
    private function getOriginFilterArray()
    {
        $array = $this->originRepository->findAll()->order(OriginRepository::COLUMN_ORIGIN)->fetchPairs(OriginRepository::COLUMN_ID, OriginRepository::COLUMN_ORIGIN);
        return $array;
    }

    /**
     * Vrací pole s možnostmi pro combobox filtr typu knihy
     *
     * @return array
     */
    private function getBookTypeFilterArray()
    {
        $array = $this->bookTypeRepository->findAll()->order(BookTypeRepository::COLUMN_BOOK_TYPE)->fetchPairs(BookTypeRepository::COLUMN_ID, BookTypeRepository::COLUMN_BOOK_TYPE);
        return $array;
    }

    /**
     * Vrací renderer pro vlastní zobrazení názvu místo ID cizího klíče v gridu
     *
     * @param ActiveRow $activeRow
     * @param string $key
     * @param string $throughColumn
     * @param string $titleColumn
     * @param string $idColumn
     * @param string $destination
     * @return string
     * @throws \Nette\Application\UI\InvalidLinkException
     */
    private function getRenderer(ActiveRow $activeRow, string $key, string $throughColumn, string $titleColumn, string $idColumn, string $destination)
    {
        $ref = $activeRow->ref($key, $throughColumn);

        if ($ref)
        {
            $title = $ref->{$titleColumn};
            return $this->getRendererWithLink($activeRow, $title, $destination, $activeRow->{$idColumn});
        } else
        {
            return "";
        }
    }
}

interface ITransliterationGridFactory
{
    /**
     * @return TransliterationGrid
     */
    public function create();
}