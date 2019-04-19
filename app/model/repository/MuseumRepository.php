<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `museum`
 *
 * @package Model\Repository
 */
class MuseumRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'museum';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_museum';
    const COLUMN_NAME = 'museum';
    const COLUMN_PLACE = 'place';

    /**
     * Najde muzeum podle jména v DB
     *
     * @param string $name
     * @return \Nette\Database\Table\Selection
     */
    public function findByName(string $name)
    {
        return $this->findBy([self::COLUMN_NAME => $name]);
    }
}