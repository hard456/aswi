<?php

namespace App\FrontModule\Components;


use App\Enum\EAdjacentLines;
use App\Enum\EPageLimit;
use App\Model\Repository\TransliterationRepository;
use App\Model\TransliterationSearchModel;
use App\Utils\Form;
use App\Utils\Paginator;
use Nette\Application\UI\Control;
use Tracy\Debugger;

class TransliterationSearchResultList extends Control
{
    /** @var TransliterationSearchModel */
    private $transliterationSearchModel;

    /** @var TransliterationRepository */
    private $transliterationRepository;

    /** @var PaginatorControl */
    private $paginator;

    /**
     * @var \Nette\Utils\ArrayHash|null
     * @persistent
     */
    private $searchTerms;

    private $resultRows;
    private $totalCount;

    private $adjacentLines;

    /**
     * TransliterationSearchResultList constructor.
     * @param TransliterationSearchModel $transliterationSearchModel
     * @param TransliterationRepository $transliterationRepository
     * @throws \Nette\Application\AbortException
     */
    public function __construct(TransliterationSearchModel $transliterationSearchModel, TransliterationRepository $transliterationRepository)
    {
        parent::__construct();
        $this->transliterationSearchModel = $transliterationSearchModel;
        $this->transliterationRepository = $transliterationRepository;
        $this->paginator = new Paginator(1, 10);

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

        $this->resultRows = $this->transliterationRepository->transliterationsFulltextSearch($this->searchTerms, $this->paginator->getOffset(), $this->paginator->getPageSize());
        $this->paginator->setPageCount($this->totalCount);

        $this->template->resultRows = $this->resultRows;
        $this->template->paginator = $this->paginator;
        $this->template->render();
    }

    public function handleChangePage($page, $limit)
    {
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