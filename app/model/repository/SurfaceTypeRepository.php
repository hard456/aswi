<?php

namespace App\Model\Repository;

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

    /**
     * Vrací typy povrchů pro formulář pro přidávání transliterací
     *
     * @return array
     */
    public function fetchSurfaceTypes()
    {
        return $this->findAll()->order(self::COLUMN_SORTER)->fetchPairs(self::COLUMN_ID, self::COLUMN_SURFACE_TYPE);
    }
}