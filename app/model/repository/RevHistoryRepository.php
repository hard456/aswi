<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `rev_hisotry`
 *
 * @package Model\Repository
 */
class RevHistoryRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'rev_history';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_rev_history';
    const COLUMN_TRANSLITERATION_ID = 'id_transliteration';
    const COLUMN_DATE = 'date';
    const COLUMN_NAME = 'name';
    const COLUMN_DESCRIPTION = 'description';
}