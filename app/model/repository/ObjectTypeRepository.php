<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `object_type`
 *
 * @package model\repository
 */
class ObjectTypeRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'object_type';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_object_type';
    const COLUMN_OBJECT_TYPE = 'object_type';
}