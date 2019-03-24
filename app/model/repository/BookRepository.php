<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `book`
 *
 * @package Model
 */
class BookRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'book';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_book';
    const COLUMN_BOOK_ABREV = 'book_abrev';
    const COLUMN_BOOK_AUTHOR = 'book_autor';
    const COLUMN_BOOK_DESCRIPTION = 'book_description';
    const COLUMN_BOOK_NAME = 'book_name';
    const COLUMN_BOOK_SUBTITLE = 'book_subtitle';
    const COLUMN_PLACE_OF_PUB = 'place_of_pub';
    const COLUMN_DATE_OF_PUB = 'date_of_pub';
    const COLUMN_PAGES = 'pages';
    const COLUMN_VOLUME = 'volume';
    const COLUMN_VOLUME_NO = 'volume_no';
    const COLUMN_REVISION_HISTORY = 'revision_history';
}