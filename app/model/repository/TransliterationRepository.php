<?php

namespace App\Model\Repository;

use App\Enum\ESearchFormOperators;
use Nette\Utils\ArrayHash;
use Tracy\Debugger;

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
     * @param ArrayHash $queryParams objekt s podmínkami pro hledaný text
     * @param $offset null|int
     * @param $limit null|int
     * @return \Nette\Database\ResultSet
     */
    public function transliterationsFulltextSearch(ArrayHash $queryParams,int $offset = null,int $limit = null)
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
            $where .= "l.transliteration REGEXP ? ";
            $whereArgs[] = $this->prepareSearchRegExp($queryParams['word1']);
        }

        if($queryParams['word2_condition'])
        {
            if($queryParams['exact_match'])
            {
                $where .= ESearchFormOperators::$wordWhereCondition[$queryParams['word2_condition']] . " l.transliteration LIKE ? ";
                $whereArgs[] = "%" . $queryParams['word2'] . "%";
            }
            else
            {
                $where .= ESearchFormOperators::$wordWhereCondition[$queryParams['word2_condition']] . " l.transliteration REGEXP ? ";
                $whereArgs[] = $this->prepareSearchRegExp($queryParams['word2']);
            }
        }

        if($queryParams['word3_condition'])
        {
            if($queryParams['exact_match'])
            {
                $where .= ESearchFormOperators::$wordWhereCondition[$queryParams['word3_condition']] . " l.transliteration LIKE ? ";
                $whereArgs[] = "%" . $queryParams['word3'] . "%";
            }
            else
            {
                $where .= ESearchFormOperators::$wordWhereCondition[$queryParams['word3_condition']] . " l.transliteration REGEXP ? ";
                $whereArgs[] = $this->prepareSearchRegExp($queryParams['word3']);
            }
        }

        if($queryParams['book'])
        {
            $where .= ' AND b.book_name' . ESearchFormOperators::$selectLikeOperatorQueryCondition[$queryParams['book_condition']];
            $whereArgs[] = $this->prepareQueryArgByOperator($queryParams['book'], $queryParams['book_condition']);
        }

        if($queryParams['museum'])
        {
            $where .= ' AND t.museum_no' . ESearchFormOperators::$selectLikeOperatorQueryCondition[$queryParams['museum_condition']];
            $whereArgs[] = $this->prepareQueryArgByOperator($queryParams['museum'], $queryParams['museum_condition']);
        }

        if($queryParams['type'])
        {
            $where .= ' AND t.id_book_type' . ESearchFormOperators::$selectEqualsOperatorQueryCondition[$queryParams['type_condition']];
            $whereArgs[] = $queryParams['type'];
        }

        if($queryParams['origin'])
        {
            $where .= ' AND t.id_origin' . ESearchFormOperators::$selectEqualsOperatorQueryCondition[$queryParams['origin_condition']];
            $whereArgs[] = $queryParams['origin'];
        }

        if($queryParams['registration'])
        {
            $where .= ' AND t.reg_no' . ESearchFormOperators::$selectLikeOperatorQueryCondition[$queryParams['registration_condition']];
            $whereArgs[] = $this->prepareQueryArgByOperator($queryParams['registration'], $queryParams['registration_condition']);
        }

        if($queryParams['date'])
        {
            $where .= ' AND t.date' . ESearchFormOperators::$selectLikeOperatorQueryCondition[$queryParams['date_condition']];
            $whereArgs[] = $this->prepareQueryArgByOperator($queryParams['date'], $queryParams['date_condition']);
        }

        $query = "SELECT 
                    t.id_transliteration as id, 
                    b.book_abrev, 
                    t.chapter, 
                    l.transliteration, 
                    l.line_number 
                  FROM transliteration t
                  LEFT JOIN surface s ON s.id_transliteration = t.id_transliteration
                  LEFT JOIN line l ON l.id_surface = s.id_surface
                  LEFT JOIN book b ON t.id_book = b.id_book
                  WHERE " . $where .
                 " ORDER BY id DESC ";

        if($offset !== null && $limit !== null)
        {
            $query .= ' LIMIT ?, ? ';
            $whereArgs[] = (int) $offset;
            $whereArgs[] = (int) $limit;
        }

        return $this->context->queryArgs($query, $whereArgs);
    }

    public function getTransliterationsFulltextSearchTotalCount($queryParams)
    {
        return $this->transliterationsFulltextSearch($queryParams, null, null)->getRowCount();
    }

    /**
     * Vytváří regulární výraz z hledaného slova, escapuje regexp znaky
     * @param $word string hledané slovo
     * @return string Regexp
     */
    private function prepareSearchRegExp(string $word)
    {
        $splitWord = preg_split('//u',$word, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($splitWord as &$char)
        {
            $char = preg_quote($char);
        }
        $regex = implode("[\[\]⌈⌉?!><\.₁₂₃₄₅₆₇₈₉₀\-\s]*?", $splitWord);
        return $regex;
    }

    /**
     * Připraví argument pro dotaz podle zvoleného operátoru
     * @param $word string
     * @param $op string operátor pro porovnání s ESearchFormOperators
     * @return string
     */
    private function prepareQueryArgByOperator($word, $op)
    {
        switch ($op)
        {
            case ESearchFormOperators::CONTAINS:
                return '%' . $word . '%';
            case ESearchFormOperators::BEGINS_WITH:
                return $word . '%';
            case ESearchFormOperators::ENDS_WITH:
                return '%' . $word;
            default:
                return $word;
        }
    }

    /**
     * @param int $id id transliterace
     * @return bool|\Nette\Database\IRow|\Nette\Database\Row
     */
    public function getTransliterationDetail(int $id)
    {
        return $this->context->query(
            "SELECT 
                    t.id_transliteration as id,
                    t.chapter,
                    t.museum_no,
                    t.reg_no,
                    t.date,
                    t.note,
                    b.*, 
                    bt.book_type,
                    m.museum,
                    m.place,
                    o.*
                  FROM transliteration t
                  LEFT JOIN surface s ON s.id_transliteration = t.id_transliteration
                  LEFT JOIN book b on t.id_book = b.id_book
                  LEFT JOIN book_type bt on t.id_book_type =bt.id_book_type
                  LEFT JOIN museum m on t.id_museum = m.id_museum
                  LEFT JOIN origin o on t.id_origin = o.id_origin
                  WHERE t.id_transliteration = ?", $id
        )->fetch();
    }
}