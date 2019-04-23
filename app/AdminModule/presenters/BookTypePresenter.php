<?php


namespace App\AdminModule\Presenters;

use App\AdminModule\Components\IBookTypeEditFormFactory;
use App\AdminModule\Components\IBookTypeGridFactory;
use App\Model\Repository\BookTypeRepository;

class BookTypePresenter extends BaseUserPresenter
{

    /**
     * @var IBookTypeGridFactory
     */
    private $bookTypeGridFactory;

    /**
     * @var IBookTypeEditFormFactory
     */
    private $bookTypeEditFormFactory;

    /**
     * @var BookTypeRepository
     */
    private $bookTypeRepository;

    public function __construct(IBookTypeGridFactory $bookTypeGridFactory,
                                IBookTypeEditFormFactory $bookTypeEditFormFactory,
                                BookTypeRepository $bookTypeRepository)
    {
        parent::__construct();

        $this->bookTypeGridFactory = $bookTypeGridFactory;
        $this->bookTypeEditFormFactory = $bookTypeEditFormFactory;
        $this->bookTypeRepository = $bookTypeRepository;
    }

    public function actionEdit(int $id)
    {
        $this['bookTypeEditForm']->setBookType($id);
    }

    /**
     * Handle používaný v BookTypeGrid pro smazání typu knihy
     *
     * @param int $id : ID mazaného typu knihy
     */
    public function handleDeleteBookType(int $id)
    {
        if ($this->isAjax())
        {
            $this->bookTypeRepository->findRow($id)->delete();
            $this['bookTypeGrid']->reload();
        }
    }

    public function createComponentBookTypeGrid()
    {
        return $this->bookTypeGridFactory->create();
    }

    public function createComponentBookTypeEditForm()
    {
        return $this->bookTypeEditFormFactory->create();
    }

}