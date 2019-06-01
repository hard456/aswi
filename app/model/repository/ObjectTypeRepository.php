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

    /**
     * Vrací typy objektů pro formulář pro přidávání transliterací
     *
     * @return array
     */
    public function fetchObjectTypes()
    {
        return $this->findAll()->fetchPairs(self::COLUMN_ID, self::COLUMN_OBJECT_TYPE);
    }

    /**
     * Vrací typ objektu podle názvu
     *
     * @param string $name
     * @return false|\Nette\Database\Table\ActiveRow
     */
    public function fetchObjectTypeByName(string $name)
    {
        return $this->findBy([self::COLUMN_OBJECT_TYPE => $name])->fetch();
    }
}