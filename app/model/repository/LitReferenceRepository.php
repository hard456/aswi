<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `lit_reference`
 *
 * @package Model\Repository
 */
class LitReferenceRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'lit_reference';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_lit_reference';
    const COLUMN_SERIES = 'series';
    const COLUMN_NUMBER = 'number';
    const COLUMN_PLATE = 'plate';
    const COLUMN_TRANSLITERATION_ID = 'id_transliteration';
}