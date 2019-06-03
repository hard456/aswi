<?php


namespace App\AdminModule\Components;


use Nette\Application\UI\Control;

class TransliterationNewForm extends Control
{


    /**
     * TransliterationNewForm constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationNewForm.latte');
        $this->template->render();
    }

}

interface ITransliterationNewFormFactory
{

    /**
     * @return TransliterationNewForm
     */
    public function create();

}