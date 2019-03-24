<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `line`
 *
 * @package model\repository
 */
class LineRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'line';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_line';
    const COLUMN_TRANSLITERATION = 'transliteration';
    const COLUMN_SURFACE_ID = 'id_surface';
    const COLUMN_BROKEN = 'broken';
    const COLUMN_OLD_BOOKANDCHAPTER = 'old_bookandchapter';
    const COLUMN_LINE_NUMBER = 'line_number';
}