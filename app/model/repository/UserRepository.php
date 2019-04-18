<?php

namespace App\Model\Repository;

use Nette\Database\Table\ActiveRow;

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

    /**
     * Nalezne uživatele v DB podle loginu
     *
     * @param string $login
     * @return ActiveRow|false
     */
    public function findByLogin(string $login)
    {
        return $this->findBy([self::COLUMN_LOGIN => $login])->fetch();
    }

    /**
     * Nalezne uživatele v DB podle jeho ID
     *
     * @param int $id
     * @return \Nette\Database\Table\Selection
     */
    public function findById(int $id)
    {
        return $this->findBy([self::COLUMN_ID => $id]);
    }
}