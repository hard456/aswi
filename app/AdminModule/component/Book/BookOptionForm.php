<?php


namespace App\AdminModule\Components;


use App\Model\Repository\BookRepository;
use App\Model\Repository\TransliterationRepository;
use App\Utils\Form;

class BookOptionForm extends BookEditForm
{

    public function render()
    {
        parent::render();
        $this->template->setFile(__DIR__ . '/BookOptionForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {

        $this->form->addRadioList('book', 'Book option', [0 => 'Existing book', 1 => 'New book'])
            ->addCondition($this->form::EQUAL, 0)
            ->toggle(TransliterationRepository::COLUMN_BOOK_ID)
            ->elseCondition($this->form::EQUAL, 1)
            ->toggle(BookRepository::COLUMN_BOOK_ABREV)
            ->toggle(BookRepository::COLUMN_BOOK_AUTHOR)
            ->toggle(BookRepository::COLUMN_BOOK_NAME)
            ->toggle(BookRepository::COLUMN_BOOK_SUBTITLE)
            ->toggle(BookRepository::COLUMN_BOOK_DESCRIPTION)
            ->toggle(BookRepository::COLUMN_PLACE_OF_PUB)
            ->toggle(BookRepository::COLUMN_DATE_OF_PUB)
            ->toggle(BookRepository::COLUMN_PAGES)
            ->toggle(BookRepository::COLUMN_VOLUME)
            ->toggle(BookRepository::COLUMN_VOLUME_NO)
            ->endCondition();

        $this->form->addSelect(TransliterationRepository::COLUMN_BOOK_ID, 'Book', $this->bookRepository->getBookAbbrevForSelect())
            ->setOption('id', TransliterationRepository::COLUMN_BOOK_ID);

        $this->form->addText(BookRepository::COLUMN_BOOK_ABREV, 'Abbreviation')
            ->addRule(Form::REQUIRED, 'Field %label is required', TRUE)
            ->setOption('id', BookRepository::COLUMN_BOOK_ABREV);

        $this->form->addText(BookRepository::COLUMN_BOOK_AUTHOR, 'Author')
            ->setOption('id', BookRepository::COLUMN_BOOK_AUTHOR);

        $this->form->addText(BookRepository::COLUMN_BOOK_NAME, 'Name')
            ->addRule(Form::REQUIRED, 'Field %label is required', TRUE)
            ->setOption('id', BookRepository::COLUMN_BOOK_NAME);

        $this->form->addText(BookRepository::COLUMN_BOOK_SUBTITLE, 'Alternate name')
            ->setOption('id', BookRepository::COLUMN_BOOK_SUBTITLE);

        $this->form->addTextArea(BookRepository::COLUMN_BOOK_DESCRIPTION, 'Description')
            ->setOption('id', BookRepository::COLUMN_BOOK_DESCRIPTION);

        $this->form->addText(BookRepository::COLUMN_PLACE_OF_PUB, 'Publication place')
            ->setOption('id', BookRepository::COLUMN_PLACE_OF_PUB);

        $this->form->addText(BookRepository::COLUMN_DATE_OF_PUB, 'Publication date')
            ->setOption('id', BookRepository::COLUMN_DATE_OF_PUB);

        $this->form->addText(BookRepository::COLUMN_PAGES, 'Pages')
            ->setOption('id', BookRepository::COLUMN_PAGES);

        $this->form->addText(BookRepository::COLUMN_VOLUME, 'Volume')
            ->setOption('id', BookRepository::COLUMN_VOLUME);

        $this->form->addText(BookRepository::COLUMN_VOLUME_NO, 'Volume No.')
            ;

        $this->form->setDefaults($this->getDefaults());
        $this->form->setDefaults(['book' => '1']);

        $this->form->addSubmit('submit', 'Save');

        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

}

interface IBookOptionFormFactory
{
    /**
     * @return BookOptionForm
     */
    public function create();
}