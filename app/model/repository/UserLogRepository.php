<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `user_log`
 *
 * @package model\repository
 */
class UserLogRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'user_log';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id';
    const COLUMN_LOGGED_DATE = 'logged';
    const COLUMN_IP = 'ip';
    const COLUMN_CLIENT = 'client';
    const COLUMN_USER_ID = 'user_id';
}