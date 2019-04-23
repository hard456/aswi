<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `origin`
 *
 * @package model\repository
 */
class OriginRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'origin';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_origin';
    const COLUMN_ORIGIN = 'origin';
    const COLUMN_OLD_NAME = 'old_name';

    /**
     * Return all origins for select values
     * @return array
     */
    public function getOriginsForSelect()
    {
        $origins = $this->findAll()->fetchPairs(self::COLUMN_ID, self::COLUMN_ORIGIN);
        $origins[0] = '- NOT SELECTED -';
        return $origins;
    }
}