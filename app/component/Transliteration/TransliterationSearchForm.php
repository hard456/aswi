<?php

namespace App\Components;

use App\Enum\ELogicalConditions;
use Nette\Application\UI\Control;
use Nette\Forms\Form;

class TransliterationSearchForm extends Control
{
    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationSearchForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $form = new Form();
        $form->addText('word1', 'Word 1');
        $form->addText('word2', 'Word 2');
        $form->addSelect('word2_condition', '', ELogicalConditions::$selectValues);
        $form->addText('word3', 'Word 3');
        $form->addSelect('word3_condition', '', ELogicalConditions::$selectValues);

        $form->addSubmit('submit', 'Search');

        $form->onSuccess[] = [$this, 'formSubmit'];

        return $form;
    }

    public function formSubmit()
    {

    }
}

interface ITransliterationSearchFormFactory{
    /**
     * @return TransliterationSearchForm
     */
    public function create();
}