<?php

namespace App\Model\Repository;

/**
 * Repository pro práci s tabulkou `line`
 *
 * @package model\repository
 */
class LineRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'line';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_line';
    const COLUMN_TRANSLITERATION = 'transliteration';
    const COLUMN_SURFACE_ID = 'id_surface';
    const COLUMN_BROKEN = 'broken';
    const COLUMN_OLD_BOOKANDCHAPTER = 'old_bookandchapter';
    const COLUMN_LINE_NUMBER = 'line_number';

    public function getAllLinesForTransliteration($transliterationId)
    {
        return $this->context->query(
            "SELECT
                         l.line_number,
                         l.transliteration,
                         st.surface_type,
                         o.object_type
                  FROM line l
                         LEFT JOIN surface s on l.id_surface = s.id_surface
                         LEFT JOIN surface_type st on s.id_surface_type = st.id_surface_type
                         LEFT JOIN transliteration t on s.id_transliteration = t.id_transliteration
                         LEFT JOIN object_type o on s.id_object_type = o.id_object_type
                  WHERE t.id_transliteration = ?
                  ORDER BY st.sorter ASC, id_line ASC",
            $transliterationId
        );
    }

    /**
     * Returns lines of a surface adjacent to passed line by id
     * @param $lineId
     * @param $surfaceId
     * @param $numberOfLines number of adjacent lines
     * @return array of arrays of lines before and lines after
     */
    public function getAdjacentLines($lineId, $surfaceId, $numberOfLines)
    {
        $adjacentLines['linesBefore'] = [];
        $adjacentLines['linesAfter'] = [];
        if($numberOfLines < 1)
        {
            return $adjacentLines;
        }

        $linesBefore = $this->getTable()
            ->select('line_number, transliteration')
            ->where('id_surface = ? AND id_line < ?', $surfaceId, $lineId)
            ->limit($numberOfLines)
            ->order('line_number * 1 DESC')
            ->fetchAll();
        $adjacentLines['linesBefore'] = array_reverse($linesBefore);

        $linesAfter = $this->getTable()
            ->select('line_number, transliteration')
            ->where('id_surface = ? AND id_line > ?', $surfaceId, $lineId)
            ->limit($numberOfLines)
            ->order('line_number * 1 ASC')
            ->fetchAll();
        $adjacentLines['linesAfter'] = $linesAfter;

        return $adjacentLines;
    }

    /**
     * Vrací záznam řádku podle ID (z nějakého důvodu mi nefungovalo findRow);
     *
     * @param int $id : ID řádky
     * @return false|\Nette\Database\Table\ActiveRow
     */
    public function fetchById(int $id)
    {
        return $this->findBy([self::COLUMN_ID => $id])->fetch();
    }

}