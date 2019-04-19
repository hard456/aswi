<?php

namespace App\Model\Repository;

use App\Enum\ELogicalConditions;

/**
 * Repository pro práci s tabulkou `transliteration`
 *
 * @package Model\Repository
 */
class TransliterationRepository extends Repository
{
    /** @var string Název tabulky */
    const TABLE_NAME = 'transliteration';
    protected $tableName = self::TABLE_NAME;

    /** Sloupečky tabulky */
    const COLUMN_ID = 'id_transliteration';
    const COLUMN_CHAPTER = 'chapter';
    const COLUMN_BOOK_ID = 'id_book';
    const COLUMN_MUSEUM_NO = 'museum_no';
    const COLUMN_MUSEUM_ID = 'id_museum';
    const COLUMN_ORIGIN_ID = 'id_origin';
    const COLUMN_OLD_BOOKANDCHAPTER = 'old_bookandchapter';
    const COLUMN_BOOK_TYPE_ID = 'id_book_type';
    const COLUMN_REG_NO = 'reg_no';
    const COLUMN_DATE = 'date';
    const COLUMN_NOTE = 'note';

    /**
     * Vyhledává texty podle slov v řádcích textu
     * @param $queryParams array podmínky pro hledaný text
     * @return \Nette\Database\ResultSet
     */
    public function transliterationsFulltextSearch($queryParams)
    {
        $where = '';
        $whereArgs = [];

        if($queryParams['exact_match'])
        {
            $where .= "l.transliteration LIKE ? ";
            $whereArgs[] = "%" . $queryParams['word1'] . "%";
        }
        else
        {
            // padá při zadávání diakritiky?
            $splitWord = str_split($queryParams['word1']);
            $regex = implode("[\[\]⌈⌉?!><\.₁₂₃₄₅₆₇₈₉₀\-\s]*?", $splitWord);
            $where .= "l.transliteration REGEXP ? ";
            $whereArgs[] = $regex;
        }

        if($queryParams['word2_condition'])
        {
            $where .= ELogicalConditions::$whereCondition[$queryParams['word2_condition']] . " l.transliteration LIKE ? ";
            $whereArgs[] = "%" . $queryParams['word2'] . "%";
        }

        if($queryParams['word3_condition'])
        {
            $where .= ELogicalConditions::$whereCondition[$queryParams['word3_condition']] . " l.transliteration LIKE ? ";
            $whereArgs[] = "%" . $queryParams['word3'] . "%";
        }

        $query = "SELECT b.book_abrev, t.chapter, l.transliteration, l.line_number FROM transliteration t
                  LEFT JOIN surface s ON s.id_transliteration = t.id_transliteration
                  LEFT JOIN line l ON l.id_surface = s.id_surface
                  LEFT JOIN book b on t.id_book = b.id_book
                  WHERE " . $where;

        return $this->context->queryArgs($query, $whereArgs);
    }
}