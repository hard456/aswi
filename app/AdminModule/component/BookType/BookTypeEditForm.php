<?php

namespace App\AdminModule\Components;

use App\Enum\EFlashMessage;
use App\Model\Repository\BookTypeRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

class BookTypeEditForm extends Control
{

    /**
     * @var Form
     */
    private $form;
    /**
     * @var int ID book type
     */
    private $bookTypeId;

    /**
     * @var BookTypeRepository
     */
    private $bookTypeRepository;

    /**
     * BookTypeEditForm constructor.
     * @param Form $form
     * @param int $bookTypeId
     * @param BookTypeRepository $bookTypeRepository
     */
    public function __construct(BookTypeRepository $bookTypeRepository)
    {
        parent::__construct();

        $this->form = new Form;
        $this->bookTypeId = NULL;
        $this->bookTypeRepository = $bookTypeRepository;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/BookTypeEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addText(BookTypeRepository::COLUMN_BOOK_TYPE, 'Book Type')
            ->addRule(Form::REQUIRED, 'Pole %label je povinné.');

        $this->form->addSubmit('submit', 'Save');

        $this->form->setDefaults($this->getDefaults());

        $this->form->onValidate[] = [$this, 'formValidate'];
        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

    public function formValidate(Form $form)
    {
        $values = $form->getValues();

        //Vložení nového book type - kontrola zda již neexistuje se stejným názvem
        if(empty($this->bookTypeId))
        {
            if ($this->bookTypeRepository->findByBookType($values[BookTypeRepository::COLUMN_BOOK_TYPE])->fetch())
            {
                $form->addError('Book type with the same name already exists. Please choose another name.');
            }
        }
    }

    public function formSuccess(Form $form)
    {
        $result = $this->bookTypeRepository->save($form->getValues(TRUE), $this->bookTypeId);

        if ($result)
        {
            $this->presenter->flashMessage('Book type was added successfully.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('BookType:edit', ['id' => $result->{BookTypeRepository::COLUMN_ID}]);
        } else
        {
            $form->addError('Book type couldn\'t be added. Please try it again later.');
        }
    }

    /**
     * Nastavení ID book type při editaci
     *
     * @param int $bookTypeId
     */
    public function setBookType(int $bookTypeId)
    {
        $this->bookTypeId = $bookTypeId;
    }

    /**
     * Vrací hodnoty z databáze při upravování existujícího typu knížky
     *
     * @return array
     */
    public function getDefaults()
    {
        $defaultValues = array();

        if (!empty($this->bookTypeId))
        {
            $bookTypeRow = $this->bookTypeRepository->findRow($this->bookTypeId);

            if ($bookTypeRow)
            {
                $defaultValues = $bookTypeRow->toArray();
            }
        }

        return $defaultValues;
    }

}

interface IBookTypeEditFormFactory
{
    /**
     * @return BookTypeEditForm
     */
    public function create();
}