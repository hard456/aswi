<?php

namespace App\FrontModule\Components;


use App\Enum\EAdjacentLines;
use App\Enum\EPageLimit;
use App\Enum\ESearchFormOperators;
use App\Model\Repository\LineRepository;
use App\Model\Repository\TransliterationRepository;
use App\Model\TransliterationSearchModel;
use App\Utils\Form;
use App\Utils\Paginator;
use Nette\Application\UI\Control;

class TransliterationSearchResultList extends Control
{
    /** @var TransliterationSearchModel */
    private $transliterationSearchModel;

    /** @var TransliterationRepository */
    private $transliterationRepository;

    /** @var LineRepository */
    private $lineRepository;

    /** @var Paginator */
    private $paginator;

    /**
     * @var \Nette\Utils\ArrayHash|null
     * @persistent
     */
    private $searchTerms;

    private $resultRows;
    private $totalCount;

    /**
     * @persistent
     */
    public $adjacentLines;

    /**
     * @persistent
     */
    public $page;

    /**
     * @persistent
     */
    public $limit;

    /**
     * TransliterationSearchResultList constructor.
     * @param TransliterationSearchModel $transliterationSearchModel
     * @param TransliterationRepository $transliterationRepository
     * @param LineRepository $lineRepository
     * @throws \Nette\Application\AbortException
     */
    public function __construct(
        TransliterationSearchModel $transliterationSearchModel,
        TransliterationRepository $transliterationRepository,
        LineRepository $lineRepository
    )
    {
        parent::__construct();
        $this->transliterationSearchModel = $transliterationSearchModel;
        $this->transliterationRepository = $transliterationRepository;
        $this->lineRepository = $lineRepository;

        if(!$this->page)
        {
            $this->page = 1;
        }

        if(!$this->limit)
        {
            $this->limit = EPageLimit::$defaultLimit;
        }
        $this->paginator = new Paginator($this->page, $this->limit);

        $this->searchTerms = $this->transliterationSearchModel->getSearchTerms();
        $this->totalCount = $this->transliterationRepository->getTransliterationsFulltextSearchTotalCount($this->searchTerms);

        if (!$this->searchTerms)
        {
            $this->presenter->redirect('Transliteration:search');
        }

        if(!$this->searchTerms['word1'])
        {
            $this->presenter->redirect('Transliteration:search');
        }
    }


    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationSearchResultList.latte');

        $this->resultRows = $this->transliterationRepository->transliterationsFulltextSearch($this->searchTerms, $this->paginator->getOffset(), $this->paginator->getPageSize())->fetchAll();
        $this->paginator->setPageCount($this->totalCount);

        $this->highlight();
        if(in_array($this->adjacentLines, EAdjacentLines::$lines) && $this->adjacentLines > 0)
        {
            foreach ($this->resultRows as &$row)
            {
                $row['adjacentLines'] = $this->lineRepository->getAdjacentLines($row['line_id'], $row['surface_id'], $this->adjacentLines);
            }
        }

        $this->template->resultRows = $this->resultRows;
        $this->template->paginator = $this->paginator;
        $this->template->render();
    }

    public function highlight()
    {
        foreach ($this->resultRows as $resultRow)
        {
            //nejprve escape html znaků, které chceme nechat zobrazovat,
            //jelikož následně přidáváme html tagy pro vyznačení a výstup v latte nemůže být escapovaný
            $resultRow->transliteration = htmlspecialchars($resultRow->transliteration);

            $resultRow->transliteration = preg_replace(
                "/" . $this->transliterationRepository->prepareSearchRegExp($this->searchTerms['word1']) . "/",
                "<span class='found'>$0</span>",
                $resultRow->transliteration);

            /**
             * TODO: dořešit označování slov, když se zadají slova co se překrývají tak se tagy mezi sebou ruší,
             * viz např. vyhledávání slov 'šu' a 'as'
             */
            if($this->searchTerms['word2_condition'] === ESearchFormOperators::AND || $this->searchTerms['word2_condition'] === ESearchFormOperators::OR )
            {
                $resultRow->transliteration = preg_replace(
                    "/" . $this->transliterationRepository->prepareSearchRegExp($this->searchTerms['word2']) . "/",
                    "<span class='found'>$0</span>",
                    $resultRow->transliteration);
            }

            if($this->searchTerms['word3_condition'] === ESearchFormOperators::AND || $this->searchTerms['word3_condition'] === ESearchFormOperators::OR )
            {
                $resultRow->transliteration = preg_replace(
                    "/" . $this->transliterationRepository->prepareSearchRegExp($this->searchTerms['word3']) . "/",
                    "<span class='found'>$0</span>",
                    $resultRow->transliteration);
            }
        }
    }

    public function handleChangePage($page, $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->paginator = new Paginator($page, $limit);
        $this->redrawControl('resultList');
    }

    public function createComponentSearchSettingsForm()
    {
        $form = new Form();

        $form->addSelect('limit', 'Results per page: ', EPageLimit::$selectValues)
            ->setDefaultValue($this->paginator->getPageSize());
        $form->addSelect('lines', 'Show adjacent lines', EAdjacentLines::$selectValues)
            ->setDefaultValue($this->adjacentLines);

        return $form;
    }

    public function handleChangeLimit()
    {
        if($this->presenter->isAjax())
        {
            $limit = $this->presenter->getParameter('limit');

            if($limit !== null)
            {
                $this->paginator = new Paginator(1, $limit);
                $this['searchSettingsForm']->setDefaults(array('limit' => $limit));
                $this->redrawControl('resultList');
            }
        }
    }

    public function handleChangeLines()
    {
        if($this->presenter->isAjax())
        {
            $lines = $this->presenter->getParameter('lines');

            if($lines !== null)
            {
                $this->adjacentLines = $lines;
                $this->paginator = new Paginator($this->page, $this->limit);

                $this['searchSettingsForm']->setDefaults(array('lines' => $lines));
                $this->redrawControl('resultList');

            }
        }
    }
}

interface ITransliterationSearchResultListFactory
{
    /**
     * @return TransliterationSearchResultList
     */
    public function create();
}