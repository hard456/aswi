<?php


namespace App\AdminModule\Components;


use App\Model\Repository\BookRepository;
use App\Model\Repository\TransliterationRepository;
use App\Utils\Form;

class BookOptionForm extends BookEditForm
{
    public function createComponentForm()
    {
        $this->form->addRadioList('book', 'Book option', [0 => 'Existing book', 1 => 'New book'])
                ->addCondition(Form::EQUAL, 0)
            ->toggle(TransliterationRepository::COLUMN_BOOK_ID)
            ->elseCondition(Form::EQUAL, 1)
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

        // Vytvoření všech prvků z rodiče
        parent::createComponentForm();

        // Nastavení jejich ID jinak se neschovávají pomocí toggle
        foreach ($this->form->getControls() as $control)
        {
            $this->form[$control->getName()]->setOption('id', $control->getName());
        }

        $this->form->setDefaults(['book' => 0]);

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