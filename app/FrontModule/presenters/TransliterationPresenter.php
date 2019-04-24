<?php

namespace App\FrontModule\Presenters;



use App\FrontModule\Components\ITransliterationSearchFormFactory;
use App\FrontModule\Components\ITransliterationSearchResultListFactory;
use App\Model\Repository\LineRepository;
use App\Model\Repository\LitReferenceRepository;
use App\Model\Repository\RevHistoryRepository;
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

    /** @var LitReferenceRepository */
    private $litReferenceRepository;

    /** @var RevHistoryRepository */
    private $revHistoryRepository;

    /** @var LineRepository */
    private $lineRepository;

    /** @var ITransliterationSearchResultListFactory */
    private $transliterationSearchResultListFactory;

    public function __construct(
        ITransliterationSearchFormFactory $transliterationSearchFormFactory,
        TransliterationRepository $transliterationRepository,
        TransliterationSearchModel $transliterationSearchModel,
        LitReferenceRepository $litReferenceRepository,
        RevHistoryRepository $revHistoryRepository,
        LineRepository $lineRepository,
        ITransliterationSearchResultListFactory $transliterationSearchResultListFactory
    )
    {
        parent::__construct();

        $this->transliterationSearchFormFactory = $transliterationSearchFormFactory;
        $this->transliterationRepository = $transliterationRepository;
        $this->transliterationSearchModel = $transliterationSearchModel;
        $this->litReferenceRepository = $litReferenceRepository;
        $this->revHistoryRepository = $revHistoryRepository;
        $this->lineRepository = $lineRepository;
        $this->transliterationSearchResultListFactory = $transliterationSearchResultListFactory;
    }


    public function actionSearch()
    {

    }

    public function actionSearchResult()
    {

    }

    public function actionView($id)
    {
        $transliteration = $this->transliterationRepository->getTransliterationDetail($id);
        if(!$transliteration)
        {
            $this->presenter->flashMessage('Transliteration not found');
            $this->redirect('Transliteration:search');
        }
        $lines = $this->lineRepository->getAllLinesForTransliteration($id);
        $lineArray = [];
        foreach ($lines as $line)
        {
            $lineArray[$line->object_type][$line->surface_type][] = array('transliteration' => $line->transliteration, 'line_number' => $line->line_number);
        }

        $this->template->transliteration = $transliteration;
        $this->template->litReferences = $this->litReferenceRepository->findBy([LitReferenceRepository::COLUMN_TRANSLITERATION_ID => $id]);
        $this->template->revisionHistory = $this->revHistoryRepository->findBy([RevHistoryRepository::COLUMN_TRANSLITERATION_ID => $id]);
        $this->template->lineArray = $lineArray;
    }

    public function createComponentTransliterationSearchForm()
    {
        return $this->transliterationSearchFormFactory->create();
    }

    public function createComponentTransliterationSearchResultList()
    {
        return $this->transliterationSearchResultListFactory->create();
    }
}