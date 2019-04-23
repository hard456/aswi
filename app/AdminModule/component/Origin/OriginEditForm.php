<?php


namespace App\AdminModule\Components;


use App\Enum\EFlashMessage;
use App\Model\Repository\OriginRepository;
use App\Utils\Form;
use Nette\Application\UI\Control;

class OriginEditForm extends Control
{
    private $originId;

    /**
     * @var Form
     */
    private $form;
    /**
     * @var OriginRepository
     */
    private $originRepository;

    public function __construct(OriginRepository $originRepository)
    {
        parent::__construct();

        $this->form = new Form;
        $this->originId = NULL;
        $this->originRepository = $originRepository;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/OriginEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addText(OriginRepository::COLUMN_ORIGIN, 'Origin')
            ->addRule(Form::REQUIRED, 'Pole %label je povinné', TRUE);
        $this->form->addText(OriginRepository::COLUMN_OLD_NAME, 'Old Name')
            ->addRule(Form::REQUIRED, 'Pole %label je povinné', TRUE);

        $this->form->setDefaults($this->getDefaults());

        $this->form->addSubmit('submit', 'Save');

        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

    public function formSuccess(Form $form)
    {
        $result = $this->originRepository->save($form->getValues(TRUE), $this->originId);

        if ($result)
        {
            $this->presenter->flashMessage('Origin was added successfully.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('Origin:edit', ['id' => $result->{OriginRepository::COLUMN_ID}]);
        } else
        {
            $form->addError('Origin couldn\'t be added. Please try it again later.');
        }
    }

    /**
     * Nastavení ID původu při editaci
     *
     * @param int $originId
     */
    public function setOrigin(int $originId)
    {
        $this->originId = $originId;
    }

    /**
     * Vrací hodnoty z databáze při upravování existujícího místa původu
     *
     * @return array
     */
    public function getDefaults()
    {
        $defaultValues = array();

        if (!empty($this->originId))
        {
            $originRow = $this->originRepository->findRow($this->originId);

            if ($originRow)
            {
                $defaultValues = $originRow->toArray();
            }
        }

        return $defaultValues;
    }
}

interface IOriginEditFormFactory
{
    /**
     * @return OriginEditForm
     */
    public function create();
}