<?php

namespace App\Utils\DataGrid;

use App\Model\Repository\BookRepository;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Ublaboo\DataGrid\Column\ColumnDateTime;
use Ublaboo\DataGrid\Column\ColumnNumber;
use Ublaboo\DataGrid\Column\ColumnText;
use Ublaboo\DataGrid\DataGrid as BaseDataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;
use Ublaboo\DataGrid\Filter\FilterText;
use Ublaboo\DataGrid\Localization\SimpleTranslator;

/**
 * Třída DataGrid poskytuje DataGrid s českou lokalizací, šablonou pro Bootstrap 4 a vyhledáváním s použitím LIKE
 * @package App\Utils\DataGrid
 */
abstract class DataGrid extends BaseDataGrid
{
    /**
     * DataGrid konstruktor.
     * @param IContainer|null $parent
     * @param null $name
     *
     * @param bool $useCzechTranslations : určuje zda se má používat Grid s českým překladem
     * @throws DataGridException
     */
    public function __construct($useCzechTranslations = TRUE)
    {
        parent::__construct(NULL, NULL);

        if($useCzechTranslations)
        {
            $translator = new SimpleTranslator([
                'ublaboo_datagrid.no_item_found_reset' => 'Žádné položky nenalezeny. Filtr můžete vynulovat',
                'ublaboo_datagrid.no_item_found' => 'Žádné položky nenalezeny.',
                'ublaboo_datagrid.here' => 'zde',
                'ublaboo_datagrid.items' => 'Položky',
                'ublaboo_datagrid.all' => 'všechny',
                'ublaboo_datagrid.from' => 'z',
                'ublaboo_datagrid.reset_filter' => 'Resetovat filtr',
                'ublaboo_datagrid.group_actions' => 'Hromadné akce',
                'ublaboo_datagrid.show_all_columns' => 'Zobrazit všechny sloupce',
                'ublaboo_datagrid.hide_column' => 'Skrýt sloupec',
                'ublaboo_datagrid.action' => 'Akce',
                'ublaboo_datagrid.previous' => 'Předchozí',
                'ublaboo_datagrid.next' => 'Další',
                'ublaboo_datagrid.choose' => 'Vyberte',
                'ublaboo_datagrid.execute' => 'Provést',
                'ublaboo_datagrid.show_default_columns' => 'Zobrazit výchozí sloupce',
                'ublaboo_datagrid.filter_submit_button' => 'Filtrovat',

                'Name' => 'Jméno',
                'Inserted' => 'Vloženo'
            ]);


            $this->setTranslator($translator);
        }

        $this->setTemplateFile(__DIR__ . '/templates/datagrid.latte');

        $this->setColumnsHideable();

        $this->setAutoSubmit(false);

        $this->setStrictSessionFilterValues(false);

        $this->setDefaultPerPage(20);

        $this->init();

        $this->define();
    }

    /**
     * Abstraktní metoda, slouží k nastavení primárního klíče a nastavení datasource
     *  1. $this->setPrimaryKey();
     *  2. $this->setDataSource();
     *
     * @throws DataGridException
     */
    public abstract function init();

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public abstract function define();

    /**
     * Vrací vytvořený datagrid - používáno v továrničkách
     *
     * @return $this
     */
    public function create()
    {
        return $this;
    }

    /**
     * Nastavuje každý sloupeček řaditelný jako výchozí nastavení
     *
     * @param string $key : column name
     * @param string $name : filter label
     * @param null $column
     * @return null|ColumnText
     */
    public function addColumnText($key, $name, $column = null): ColumnText
    {
        $column = parent::addColumnText($key, $name, $column);
        $column->setSortable();

        return $column;
    }

    /**
     * Nastavuje každý sloupeček řaditelný jako výchozí nastavení
     *
     * @param string $key : column name
     * @param string $name : filter label
     * @param null $column
     * @return ColumnNumber
     */
    public function addColumnNumber($key, $name, $column = null): ColumnNumber
    {
        $column = parent::addColumnNumber($key, $name, $column);
        $column->setSortable();

        return $column;
    }

    /**
     * Nastavuje každý sloupeček řaditelný jako výchozí nastavení
     *
     * @param string $key : column name
     * @param string $name : filter label
     * @param null $column
     * @return ColumnDateTime
     */
    public function addColumnDateTime($key, $name, $column = null): ColumnDateTime
    {
        $column = parent::addColumnDateTime($key, $name, $column);
        $column->setSortable();

        return $column;
    }

    /**
     * Umožňění filtrování sloupečků s textem podle jeho jednotlivých částí pomocí LIKE SQL commandu
     *
     * @param string $key : column name
     * @param string $name : filter label
     * @param null $columns
     * @return FilterText
     * @throws DataGridException
     */
    public function addFilterText($key, $name, $columns = null): FilterText
    {
        $filterText = parent::addFilterText($key, $name, $columns);

        $filter = parent::getFilter($key);

        $filter->setCondition(function ($selection, $value) use ($key)
        {
            /** @var Selection $selection */
            $selection->where($key . ' LIKE', '%' . $value . '%');
        });

        return $filterText;
    }

    /**
     * Umožnění filtrování sloupečků s odkazem
     *
     * @param string $key
     * @param string $name
     * @param null $href
     * @param null $column
     * @param array|null $params
     * @return \Ublaboo\DataGrid\Column\ColumnLink|null
     */
    public function addColumnLink($key, $name, $href = null, $column = null, array $params = null)
    {
        $column = parent::addColumnLink($key, $name, $href, $column, $params);
        $column->setSortable();
        $column->setTemplateEscaping(FALSE);

        return $column;
    }

    /**
     * Generování odkazu pro tabulky, které jsou přes cizí klíč
     *
     * @param ActiveRow $activeRow
     * @param string $title
     * @param string $destination
     * @param int $id
     * @return string
     * @throws \Nette\Application\UI\InvalidLinkException
     */
    public function getRendererWithLink(ActiveRow $activeRow, string $title, string $destination, int $id): string
    {
        $link = $this->presenter->link($destination, ['id' => $id]);

        $title = !empty($title) ? $title : 'empty';
        return '<a href="' . $link . '">' . $title . '</a>';
    }

    /**
     * Fixnutí zobrazování všech záznamů v českém překladu gridu
     *
     * @return int
     */
    public function getPerPage()
    {
        $items_per_page_list = array_keys($this->getItemsPerPageList());

        $per_page = $this->per_page ?: reset($items_per_page_list);

        if (($per_page !== 'all' && !in_array((int) $this->per_page, $items_per_page_list, true))
            || ($per_page === 'all' && !in_array($this->per_page, $items_per_page_list, true))) {
            $per_page = reset($items_per_page_list);
        }
        return $per_page;
    }
}