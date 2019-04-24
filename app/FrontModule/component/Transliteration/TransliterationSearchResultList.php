<?php

namespace App\FrontModule\Components;


use App\Model\Repository\TransliterationRepository;
use App\Model\TransliterationSearchModel;
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

    private $searchTerms;
    private $resultRows;
    private $totalCount;

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
}

interface ITransliterationSearchResultListFactory
{
    /**
     * @return TransliterationSearchResultList
     */
    public function create();
}