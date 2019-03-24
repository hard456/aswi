<?php

namespace Model\Repository;

/**
 * Repository pro práci s tabulkou `user`
 *
 * @package model\repository
 */
class UserRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'user';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id';
    const COLUMN_USERNAME = 'username';
    const COLUMN_LOGIN = 'login';
    const COLUMN_PASSWORD = 'password';
    const COLUMN_EMAIL = 'email';
    const COLUMN_CREATED = 'created';
    const COLUMN_UPDATED = 'updated';
}