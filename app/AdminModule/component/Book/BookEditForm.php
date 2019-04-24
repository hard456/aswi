<?php


namespace App\AdminModule\Components;


use App\Enum\EFlashMessage;
use App\Model\Repository\BookRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

class BookEditForm extends Control
{
    private $bookId;

    /**
     * @var Form
     */
    private $form;
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        parent::__construct();

        $this->form = new Form;
        $this->bookId = NULL;
        $this->bookRepository = $bookRepository;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/BookEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addText(BookRepository::COLUMN_BOOK_ABREV, 'Abbreviation')
            ->addRule(Form::REQUIRED, 'Field %label is required', TRUE);
        $this->form->addText(BookRepository::COLUMN_BOOK_AUTHOR, 'Author');
        $this->form->addText(BookRepository::COLUMN_BOOK_NAME, 'Name')
            ->addRule(Form::REQUIRED, 'Field %label is required', TRUE);
        $this->form->addText(BookRepository::COLUMN_BOOK_SUBTITLE, 'Alternate name');
        $this->form->addTextArea(BookRepository::COLUMN_BOOK_DESCRIPTION, 'Description');
        $this->form->addText(BookRepository::COLUMN_PLACE_OF_PUB, 'Publication place');
        $this->form->addText(BookRepository::COLUMN_DATE_OF_PUB, 'Publication date');
        $this->form->addText(BookRepository::COLUMN_PAGES, 'Pages');
        $this->form->addText(BookRepository::COLUMN_VOLUME, 'Volume');
        $this->form->addText(BookRepository::COLUMN_VOLUME_NO, 'Volume No.');

        $this->form->setDefaults($this->getDefaults());

        $this->form->addSubmit('submit', 'Save');

        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

    public function formSuccess(Form $form)
    {
        $result = $this->bookRepository->save($form->getValues(TRUE), $this->bookId);

        if ($result)
        {
            $this->presenter->flashMessage('Book was added successfully.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('Book:edit', ['id' => $result->{BookRepository::COLUMN_ID}]);
        } else
        {
            $form->addError('Book couldn\'t be added. Please try it again later.');
        }
    }

    /**
     * Nastavení ID při editaci
     *
     * @param int $bookId
     */
    public function setId(int $bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * Vrací hodnoty z databáze při editaci existující knihy
     *
     * @return array
     */
    public function getDefaults()
    {
        $defaultValues = array();

        if (!empty($this->bookId))
        {
            $bookRow = $this->bookRepository->findRow($this->bookId);

            if ($bookRow)
            {
                $defaultValues = $bookRow->toArray();
            }
        }

        return $defaultValues;
    }
}

interface IBookEditFormFactory
{
    /**
     * @return BookEditForm
     */
    public function create();
}