<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `transliteration`
 *
 * @package Model\Repository
 */
class TransliterationRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'transliteration';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_transliteration';
    const COLUMN_CHAPTER = 'chapter';
    const COLUMN_BOOK_ID = 'id_book';
    const COLUMN_MUSEUM_NO = 'museum_no';
    const COLUMN_MUSEUM_ID = 'id_museum';
    const COLUMN_ORIGIN_ID = 'id_origin';
    const COLUMN_OLD_BOOKANDCHAPTER = 'old_bookandchapter';
    const COLUMN_BOOK_TYPE_ID = 'id_book_type';
    const COLUMN_REG_NO = 'reg_no';
    const COLUMN_DATE = 'date';
    const COLUMN_NOTE = 'note';
}