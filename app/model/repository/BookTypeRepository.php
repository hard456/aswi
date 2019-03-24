<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `book_type`
 *
 * @package model\repository
 */
class BookTypeRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'book_type';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_book_type';
    const COLUMN_BOOK_TYPE = 'book_type';
}