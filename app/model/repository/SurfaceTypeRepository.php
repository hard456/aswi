<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `surface_type`
 *
 * @package model\repository
 */
class SurfaceTypeRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'surface_type';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_surface_type';
    const COLUMN_SURFACE_TYPE = 'surface_type';
    const COLUMN_SORTER = 'sorter';
}