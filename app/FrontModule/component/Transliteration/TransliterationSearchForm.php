<?php

namespace App\FrontModule\Components;

use App\Enum\ELogicalConditions;
use App\Model\TransliterationSearchModel;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class TransliterationSearchForm extends Control
{
    /** @var TransliterationSearchModel */
    private $transliterationSearchModel;

    /**
     * TransliterationSearchForm constructor.
     * @param TransliterationSearchModel $transliterationSearchModel
     */
    public function __construct(TransliterationSearchModel $transliterationSearchModel)
    {
        parent::__construct();
        $this->transliterationSearchModel = $transliterationSearchModel;
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
            ->setRequired(true, 'Field Word 1 is required');
        $form->addText('word2', 'Word 2');
        $form->addSelect('word2_condition', '', ELogicalConditions::$selectValues);
        $form->addText('word3', 'Word 3');
        $form->addSelect('word3_condition', '', ELogicalConditions::$selectValues);

        $form->addCheckbox('exact_match', ' Exact Match');

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