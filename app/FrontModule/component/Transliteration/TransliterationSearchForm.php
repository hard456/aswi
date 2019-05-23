<?php

namespace App\FrontModule\Components;

use App\Enum\ESearchFormOperators;
use App\Model\Repository\BookTypeRepository;
use App\Model\Repository\OriginRepository;
use App\Model\TransliterationSearchModel;
use App\Utils\Form;
use Nette\Application\UI\Control;
use Nette\Utils\ArrayHash;

class TransliterationSearchForm extends Control
{
    /** @var TransliterationSearchModel */
    private $transliterationSearchModel;

    /** @var BookTypeRepository */
    private $bookTypeRepository;

    /** @var OriginRepository */
    private $originRepository;

    /**
     * TransliterationSearchForm constructor.
     * @param TransliterationSearchModel $transliterationSearchModel
     * @param BookTypeRepository $bookTypeRepository
     * @param OriginRepository $originRepository
     */
    public function __construct(
        TransliterationSearchModel $transliterationSearchModel,
        BookTypeRepository $bookTypeRepository,
        OriginRepository $originRepository
    )
    {
        parent::__construct();
        $this->transliterationSearchModel = $transliterationSearchModel;
        $this->bookTypeRepository = $bookTypeRepository;
        $this->originRepository = $originRepository;
    }


    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationSearchForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $form = new Form();

        $form->addText('word1', 'Word 1')
            ->addRule(Form::REQUIRED, 'Field %label is required.')
            ->setAttribute("autofocus");
        $form->addText('word2', 'Word 2');
        $form->addSelect('word2_condition', '', ESearchFormOperators::$wordSelectLabels);
        $form->addText('word3', 'Word 3');
        $form->addSelect('word3_condition', '', ESearchFormOperators::$wordSelectLabels);

        $form->addCheckbox('exact_match', ' Exact Match');

        $form->addSelect('book_condition', '', ESearchFormOperators::$selectLikeOperatorLabels)
            ->setDefaultValue(ESearchFormOperators::CONTAINS);
        $form->addText('book', 'Book');
        $form->addSelect('museum_condition', '', ESearchFormOperators::$selectLikeOperatorLabels)
            ->setDefaultValue(ESearchFormOperators::CONTAINS);
        $form->addText('museum', 'Museum number');

        $form->addSelect('type_condition', '', ESearchFormOperators::$selectEqualsOperatorLabels)
            ->setDefaultValue(ESearchFormOperators::IS);
        $form->addSelect('type', 'Type', $this->bookTypeRepository->getTypesForSelect());
        $form->addSelect('origin_condition', '', ESearchFormOperators::$selectEqualsOperatorLabels)
            ->setDefaultValue(ESearchFormOperators::IS);
        $form->addSelect('origin', 'Origin', $this->originRepository->getOriginsForSelect());

        $form->addSelect('registration_condition', '', ESearchFormOperators::$selectLikeOperatorLabels)
            ->setDefaultValue(ESearchFormOperators::CONTAINS);
        $form->addText('registration', 'Registration / Ex. number');

        $form->addSelect('date_condition', '', ESearchFormOperators::$selectLikeOperatorLabels)
            ->setDefaultValue(ESearchFormOperators::CONTAINS);
        $form->addText('date', 'Date');

        $form->addSubmit('submit', 'Search');
        $form->onSuccess[] = [$this, 'formSuccess'];

        return $form;
    }

    public function formSuccess(Form $form)
    {
        /** @var ArrayHash $values */
        $values = $form->getValues();
        $this->transliterationSearchModel->setSearchTerms($values);
        $this->presenter->redirect('Transliteration:searchResult');
    }
}

interface ITransliterationSearchFormFactory{
    /**
     * @return TransliterationSearchForm
     */
    public function create();
}