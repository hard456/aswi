<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `surface`
 *
 * @package model\repository
 */
class SurfaceRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'surface';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_surface';
    const COLUMN_COLUMN_NUMBER = 'column_number';
    const COLUMN_TRANSLITERATION_ID = 'id_transliteration';
    const COLUMN_OBJECT_TYPE_ID = 'id_object_type';
    const COLUMN_SURFACE_TYPE_ID = 'id_surface_type';
}