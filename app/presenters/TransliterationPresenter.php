<?php

namespace App\Presenters;


use App\Components\ITransliterationSearchFormFactory;
use Nette\Application\UI\Presenter;

class TransliterationPresenter extends Presenter
{
    /** @var ITransliterationSearchFormFactory */
    private $transliterationSearchFormFactory;

    public function __construct(ITransliterationSearchFormFactory $transliterationSearchFormFactory)
    {
        parent::__construct();

        $this->transliterationSearchFormFactory = $transliterationSearchFormFactory;
    }


    public function actionSearch()
    {

    }

    public function actionSearchResult(array $searchTerms = null)
    {

    }

    public function createComponentTransliterationSearchForm()
    {
        return $this->transliterationSearchFormFactory->create();
    }
}