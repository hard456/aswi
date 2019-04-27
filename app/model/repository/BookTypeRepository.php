<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `book_type`
 *
 * @package model\repository
 */
class BookTypeRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'book_type';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_book_type';
    const COLUMN_BOOK_TYPE = 'book_type';

    /**
     * Najde záznam podle typu knížky v DB
     *
     * @param string $bookType
     * @return \Nette\Database\Table\Selection
     */
    public function findByBookType(string $bookType)
    {
        return $this->findBy([self::COLUMN_BOOK_TYPE => $bookType]);
    }

    /**
     * Return all book types for select values
     * @return array
     */
    public function getTypesForSelect()
    {
        $types = $this->findAll()->fetchPairs(self::COLUMN_ID, self::COLUMN_BOOK_TYPE);
        $types[0] = '- NOT SELECTED -';
        return $types;
    }
}