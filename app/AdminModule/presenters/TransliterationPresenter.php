<?php


namespace App\AdminModule\Presenters;


use App\AdminModule\Components\ITransliterationGridFactory;
use App\Model\Repository\TransliterationRepository;

class TransliterationPresenter extends BaseUserPresenter
{
    /**
     * @var ITransliterationGridFactory
     */
    private $transliterationGridFactory;

    public function __construct(ITransliterationGridFactory $transliterationGridFactory,
                                TransliterationRepository $transliterationRepository)
    {
        parent::__construct();
        $this->transliterationGridFactory = $transliterationGridFactory;
    }

    /**
     * Handle používaný v TransliterationGrid pro smazání transliterace
     *
     * @param int $id : ID transliterace
     */
    public function handleDeleteTransliteration(int $id)
    {
        if ($this->isAjax())
        {
            $this->transliterationGridFactory->findRow($id)->delete();
            $this['transliterationGrid']->reload();
        }
    }

    public function createComponentTransliterationGrid()
    {
        return $this->transliterationGridFactory->create();
    }
}