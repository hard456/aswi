<?php

namespace App\Model\Repository;

use Nette;

/**
 * Základní repository s operacemi pro práci s tabulkou
 *
 * @package Model
 */
class Repository
{
    use Nette\SmartObject;

    /** @var string Název tabulky */
    protected $tableName;

    /** @var \Nette\Database\Context */
    protected $context;

    public function __construct(Nette\Database\Context $context)
    {
        $this->context = $context;
    }

    /**
     * Vrací název tabulky
     *  - pokud není definovaný odvodí se název tabulky podle názvu třídy
     *
     * @return string
     */
    public function getTableName(): string
    {
        if (empty($this->tableName))
        {
            preg_match('#(\w+)Repository$#', get_class($this), $m);
            $this->tableName = strtolower($m[1]);
        }

        return $this->tableName;
    }

    /**
     * Vrací Selection reprezentující danou tabulku
     *
     * @return Nette\Database\Table\Selection
     */
    public function getTable(): Nette\Database\Table\Selection
    {
        if (empty($this->tableName))
        {
            $this->getTableName();
        }

        return $this->context->table($this->tableName);
    }

    /**
     * Vrací všechny řádky z tabulky
     *
     * @return Nette\Database\Table\Selection
     */
    public function findAll(): Nette\Database\Table\Selection
    {
        return $this->getTable();
    }

    /**
     * Vrací řádky podle filtru
     *
     * @param array $by : associativní pole s filtry, např. array('id' => 5)
     * @return Nette\Database\Table\Selection
     */
    public function findBy(array $by): Nette\Database\Table\Selection
    {
        return $this->getTable()->where($by);
    }

    /**
     * Vrací záznam z tabulky podle primárního klíče
     *
     * @param int $id
     * @return Nette\Database\Table\ActiveRow
     */
    public function findRow(int $id): Nette\Database\Table\ActiveRow
    {
        return $this->getTable()->get($id);
    }

    /**
     * Vložení dat do tabulky
     *
     * @param array $data
     * @return bool|int|Nette\Database\Table\ActiveRow
     */
    public function insert(array $data)
    {
        return $this->getTable()->insert($data);
    }

    /**
     * Smaže záznam podle primárního klíče
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->findRow($id)->delete();
    }

    /**
     * Uloží nebo updatuje záznam v tabulce
     *  - pokud je $id NULL -> vloží nový záznam
     *  - pokud $id není NULL -> aktualizace existujícího záznamu
     *
     * @param array $data
     * @param int|NULL $id
     * @return Nette\Database\Table\ActiveRow
     */
    public function save(array $data, int $id = NULL): Nette\Database\Table\ActiveRow
    {
        if ($id == NULL)
        {
            $record = $this->insert($data);
        } else
        {
            $record = $this->findRow($id);
            $record->update($data);
        }

        return $record;
    }
}