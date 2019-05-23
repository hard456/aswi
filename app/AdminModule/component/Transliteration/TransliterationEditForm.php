<?php


namespace App\AdminModule\Components;

use App\Model\Repository\TransliterationRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

/**
 * Class TransliterationEditForm
 * @package App\AdminModule\Components
 */
class TransliterationEditForm extends Control
{

    /**
     * @var Form
     */
    private $form;
    /**
     * @var int ID transliteration
     */
    private $transliterationId;

    /**
     * @var TransliterationRepository
     */
    private $transliterationRepository;

    /**
     * TransliterationEditForm constructor.
     * @param TransliterationRepository $transliterationRepository
     */
    public function __construct(TransliterationRepository $transliterationRepository)
    {
        parent::__construct();

        $this->transliterationRepository = $transliterationRepository;
        $this->transliterationId = NULL;
        $this->form = new Form;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/TransliterationEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addText(TransliterationRepository::COLUMN_ID, 'Book Type')
            ->addRule(Form::REQUIRED, 'Field %label is required.');
        return $this->form;
    }

    /**
     * Nastavení ID transliterace při editaci
     *
     * @param int $transliterationId
     */
    public function setTransliteration(int $transliterationId)
    {
        $this->transliterationId = $transliterationId;
    }

}

interface ITransliterationEditFormFactory{

    /**
     * @return TransliterationEditForm
     */
    public function create();

}