<?php


namespace App\AdminModule\Presenters;


use App\AdminModule\Components\ITransliterationDataEditFormFactory;
use App\AdminModule\Components\ITransliterationGridFactory;
use App\AdminModule\Components\ITransliterationEditFormFactory;
use App\Model\Repository\TransliterationRepository;

class TransliterationPresenter extends BaseUserPresenter
{
    /**
     * @var ITransliterationGridFactory
     */
    private $transliterationGridFactory;

    /**
     * @var ITransliterationEditFormFactory
     */
    private $transliterationEditFormFactory;

    /**
     * @var TransliterationRepository
     */
    private $transliterationRepository;

    /**
     * @var ITransliterationDataEditFormFactory
     */
    private $transliterationDataEditFormFactory;

    public function __construct(ITransliterationGridFactory $transliterationGridFactory,
                                ITransliterationEditFormFactory $transliterationEditFormFactory,
                                TransliterationRepository $transliterationRepository,
                                ITransliterationDataEditFormFactory $transliterationDataEditFormFactory
    )
    {
        parent::__construct();
        $this->transliterationEditFormFactory = $transliterationEditFormFactory;
        $this->transliterationGridFactory = $transliterationGridFactory;
        $this->transliterationRepository = $transliterationRepository;
        $this->transliterationDataEditFormFactory = $transliterationDataEditFormFactory;
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
            $this->transliterationRepository->findRow($id)->delete();
            $this['transliterationGrid']->reload();
        }
    }

    /**
     * Editace informací o transliteraci
     *
     * @param int $id
     */
    public function actionEdit(int $id)
    {
        $this['transliterationEditForm']->setTransliteration($id);
        $this['transliterationDataEditForm']->setTransliteration($id);
    }

    public function createComponentTransliterationGrid()
    {
        return $this->transliterationGridFactory->create();
    }

    public function createComponentTransliterationEditForm()
    {
        return $this->transliterationEditFormFactory->create();
    }

    public function createComponentTransliterationDataEditForm()
    {
        return  $this->transliterationDataEditFormFactory->create();
    }

}