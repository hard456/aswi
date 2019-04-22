<?php


namespace App\AdminModule\Presenters;

use App\AdminModule\Components\IMuseumEditFormFactory;
use App\AdminModule\Components\IMuseumGridFactory;
use App\Model\Repository\MuseumRepository;

class MuseumPresenter extends BaseUserPresenter
{
    /**
     * @var IMuseumGridFactory
     */
    private $museumGridFactory;
    /**
     * @var IMuseumEditFormFactory
     */
    private $museumEditFormFactory;
    /**
     * @var MuseumRepository
     */
    private $museumRepository;

    public function __construct(IMuseumGridFactory $museumGridFactory,
                                IMuseumEditFormFactory $museumEditFormFactory,
                                MuseumRepository $museumRepository
    )
    {
        parent::__construct();

        $this->museumGridFactory = $museumGridFactory;
        $this->museumEditFormFactory = $museumEditFormFactory;
        $this->museumRepository = $museumRepository;
    }

    public function actionEdit(int $id)
    {
        $this['museumEditForm']->setMuseum($id);
    }

    /**
     * Handle používaný v MuseumGrid pro smazání muzea
     *
     * @param int $id : ID mazaného muzea
     */
    public function handleDeleteMuseum(int $id)
    {
        if ($this->isAjax())
        {
            $this->museumRepository->findRow($id)->delete();
            $this['museumGrid']->reload();
        }
    }

    public function createComponentMuseumGrid()
    {
        return $this->museumGridFactory->create();
    }

    public function createComponentMuseumEditForm()
    {
        return $this->museumEditFormFactory->create();
    }
}