<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `role`
 *
 * @package Model\Repository
 */
class RoleRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'role';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';
}