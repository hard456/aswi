<?php


namespace App\AdminModule\Presenters;


use App\AdminModule\Components\IOriginEditFormFactory;
use App\AdminModule\Components\IOriginGridFactory;
use App\Enum\EFlashMessage;
use App\Model\Repository\OriginRepository;

class OriginPresenter extends BaseUserPresenter
{
    /**
     * @var IOriginGridFactory
     */
    private $originGridFactory;
    /**
     * @var IOriginEditFormFactory
     */
    private $originEditFormFactory;
    /**
     * @var OriginRepository
     */
    private $originRepository;

    public function __construct(IOriginGridFactory $originGridFactory,
                                IOriginEditFormFactory $originEditFormFactory,
                                OriginRepository $originRepository)
    {
        parent::__construct();

        $this->originGridFactory = $originGridFactory;
        $this->originEditFormFactory = $originEditFormFactory;
        $this->originRepository = $originRepository;
    }

    public function actionEdit(int $id)
    {
        $this->template->id = $id;
        $this['originEditForm']->setOrigin($id);
    }

    /**
     * Akce pro odstranění místa původu
     *
     * @param int $id
     * @throws \Nette\Application\AbortException
     */
    public function actionDelete(int $id)
    {
        $result = $this->originRepository->findRow($id)->delete();
        if ($result)
        {
            $this->flashMessage('Origin was successfully deleted.', EFlashMessage::SUCCESS);
        } else
        {
            $this->flashMessage('Origin wasn\'t deleted.', EFlashMessage::ERROR);
        }

        $this->redirect('Origin:default');
    }

    /**
     * Handle používaný v OriginGrid pro smazání místa původu
     *
     * @param int $id : ID mazaného místa původu
     */
    public function handleDeleteOrigin(int $id)
    {
        if ($this->isAjax())
        {
            $this->originRepository->findRow($id)->delete();
            $this['originGrid']->reload();
        }
    }

    public function createComponentOriginGrid()
    {
        return $this->originGridFactory->create();
    }

    public function createComponentOriginEditForm()
    {
        return $this->originEditFormFactory->create();
    }
}