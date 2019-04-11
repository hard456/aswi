<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `museum`
 *
 * @package Model\Repository
 */
class MuseumRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'museum';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_museum';
    const COLUMN_TITLE = 'museum';
    const COLUMN_PLACE = 'place';
}