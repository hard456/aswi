<?php

namespace App\FrontModule\Presenters;



use App\FrontModule\Components\ITransliterationSearchFormFactory;
use App\Model\Repository\TransliterationRepository;
use App\Model\TransliterationSearchModel;
use Nette\Application\UI\Presenter;

class TransliterationPresenter extends Presenter
{
    /** @var ITransliterationSearchFormFactory */
    private $transliterationSearchFormFactory;

    /** @var TransliterationRepository */
    private $transliterationRepository;

    /** @var TransliterationSearchModel */
    private $transliterationSearchModel;

    public function __construct(
        ITransliterationSearchFormFactory $transliterationSearchFormFactory,
        TransliterationRepository $transliterationRepository,
        TransliterationSearchModel $transliterationSearchModel
    )
    {
        parent::__construct();

        $this->transliterationSearchFormFactory = $transliterationSearchFormFactory;
        $this->transliterationRepository = $transliterationRepository;
        $this->transliterationSearchModel = $transliterationSearchModel;
    }


    public function actionSearch()
    {

    }

    public function actionSearchResult()
    {
        $searchTerms = $this->transliterationSearchModel->getSearchTerms();

        if (!$searchTerms)
        {
            $this->redirect('Transliteration:search');
        }

        if(!$searchTerms['word1'])
        {
            $this->redirect('Transliteration:search');
        }

        $resultRows = $this->transliterationRepository->transliterationsFulltextSearch($searchTerms);

        $this->template->resultRows = $resultRows;
    }

    public function createComponentTransliterationSearchForm()
    {
        return $this->transliterationSearchFormFactory->create();
    }
}