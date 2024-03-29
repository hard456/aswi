<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `user_role`
 *
 * @package model\repository
 */
class UserRoleRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'user_role';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_USER_ID = 'user_id';
    const COLUMN_ROLE_ID = 'role_id';

    /**
     * Přiřadí roli novému uživateli
     *
     * @param int $userId
     * @param int $roleId
     * @return bool|int|\Nette\Database\Table\ActiveRow
     */
    public function addNew(int $userId, int $roleId)
    {
        return $this->insert(
            [
                UserRoleRepository::COLUMN_USER_ID => $userId,
                UserRoleRepository::COLUMN_ROLE_ID => $roleId
            ]
        );
    }
}