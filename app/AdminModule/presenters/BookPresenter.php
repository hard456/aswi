<?php


namespace App\AdminModule\Presenters;

use App\AdminModule\Components\IBookEditFormFactory;
use App\AdminModule\Components\IBookGridFactory;
use App\Enum\EFlashMessage;
use App\Model\Repository\BookRepository;

class BookPresenter extends BaseUserPresenter
{
    /**
     * @var IBookGridFactory
     */
    private $bookGridFactory;
    /**
     * @var IBookEditFormFactory
     */
    private $bookEditFormFactory;
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(
        IBookGridFactory $bookGridFactory,
        IBookEditFormFactory $bookEditFormFactory,
        BookRepository $bookRepository
    )
    {
        parent::__construct();

        $this->bookGridFactory = $bookGridFactory;
        $this->bookEditFormFactory = $bookEditFormFactory;
        $this->bookRepository = $bookRepository;
    }

    public function actionEdit(int $id)
    {
        $this->template->id = $id;
        $this['bookEditForm']->setId($id);
    }

    /**
     * Akce pro odstranění knihy
     *
     * @param int $id
     * @throws \Nette\Application\AbortException
     */
    public function actionDelete(int $id)
    {
        $result = $this->bookRepository->findRow($id)->delete();
        if ($result) {
            $this->flashMessage('Book was successfully deleted.', EFlashMessage::SUCCESS);
        } else {
            $this->flashMessage('Book wasn\'t deleted.', EFlashMessage::ERROR);
        }

        $this->redirect('Book:default');
    }

    /**
     * Handle používaný v BookGrid pro smazání knihy
     *
     * @param int $id : ID mazané knihy
     */
    public function handleDeleteBook(int $id)
    {
        if ($this->isAjax()) {
            $this->bookRepository->findRow($id)->delete();
            $this['bookGrid']->reload();
        }
    }

    public function createComponentBookGrid()
    {
        return $this->bookGridFactory->create();
    }

    public function createComponentBookEditForm()
    {
        return $this->bookEditFormFactory->create();
    }
}