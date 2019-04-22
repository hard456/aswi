<?php


namespace App\AdminModule\Components;


use App\Enum\EFlashMessage;
use App\Model\Facade\UserFacade;
use App\Model\Repository\RoleRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\UserRoleRepository;
use Nette\Application\UI\Control;
use App\Utils\Form;

class UserEditForm extends Control
{
    const PASSWORD_CONFIRM = 'password_confirm';

    /** @var Form  */
    private $form;

    /** @var int ID uživatele */
    private $userId;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserRoleRepository
     */
    private $userRoleRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var UserFacade
     */
    private $userFacade;

    public function __construct(UserRepository $userRepository,
                                UserRoleRepository $userRoleRepository,
                                RoleRepository $roleRepository,
                                UserFacade $userFacade
    )
    {
        parent::__construct();

        $this->roleRepository = $roleRepository;

        $this->userId = NULL;
        $this->form = new Form;
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->userFacade = $userFacade;
    }

    public function render()
    {
        $this->template->setFile(__DIR__ . '/UserEditForm.latte');
        $this->template->render();
    }

    public function createComponentForm()
    {
        $this->form->addText(UserRepository::COLUMN_USERNAME, 'Uživatelské jméno');
        $this->form->addText(UserRepository::COLUMN_LOGIN, 'Login')
            ->setRequired(TRUE);

        $password = $this->form->addPassword(UserRepository::COLUMN_PASSWORD, 'Heslo');
        $passwordConfirm = $this->form->addPassword(self::PASSWORD_CONFIRM, 'Potvrzení hesla')
            ->addConditionOn($password, Form::FILLED, TRUE)
            ->addRule(Form::EQUAL, 'Hesla se musejí shodovat.', $password)
            ->addRule(Form::REQUIRED, 'Pole %label je povinné')
            ->endCondition();

        if (empty($this->userId))
        {
            $password->addRule(Form::REQUIRED, 'Pole %label je povinné', TRUE);
            $passwordConfirm->addRule(Form::REQUIRED, 'Pole %label je povinné');
        }

        $this->form->addSelect(UserRoleRepository::COLUMN_ROLE_ID, 'Role uživatele', $this->getRoles())
            ->setPrompt('- Vyberte roli -')
            ->addRule(Form::REQUIRED, '%label musí být vybrána.', TRUE);
        $this->form->addText(UserRepository::COLUMN_EMAIL, 'E-mail')
            ->addRule(Form::EMAIL, 'Prvek %label musí obsahovat validní e-mail.')
            ->setRequired(FALSE);

        $this->form->setDefaults($this->getDefaults());

        $submitText = empty($this->userId) ? 'Přidat uživatele' : 'Upravit uživatele';
        $this->form->addSubmit('submit', $submitText);

        $this->form->onValidate[] = [$this, 'formValidate'];
        $this->form->onSuccess[] = [$this, 'formSuccess'];

        return $this->form;
    }

    /**
     * Validace formuláře
     *
     * @param Form $form
     */
    public function formValidate(Form $form)
    {
        $values = $form->getValues();

        // Vkládáme nového uživatele - kontrola existujícího loginu
        if (empty($this->userId))
        {
            if ($this->userRepository->findByLogin($values->{UserRepository::COLUMN_LOGIN}))
            {
                $form->addError('Uživatel se zadaným loginem již existuje.');
            }
        }
    }

    public function formSuccess(Form $form)
    {
        $result = $this->userFacade->saveUser($form->getValues(true), $this->userId);

        if ($result)
        {
            $this->presenter->flashMessage('Uživatel byl úspěšně upraven.', EFlashMessage::SUCCESS);
            $this->presenter->redirect('User:edit', ['id' => $result->{UserRepository::COLUMN_ID}]);
        } else
        {
            $form->addError('Uživatele se nepodařilo upravit.');
        }
    }

    /**
     * Nastaví uživatele do formuláře, pro předvyplnění hodnot formuláře
     *
     * @param int $userId
     */
    public function setUser(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Vrací hodnoty z databáze při upravování existujícího uživatele
     *
     * @return array
     */
    private function getDefaults()
    {
        $defaultValues = array();

        if(!empty($this->userId))
        {
            $userSelection = $this->userRepository->findById($this->userId);
            $userRow = $userSelection->fetch();

            if ($userRow)
            {
                $defaultValues = $userRow->toArray();
                $roleRow = $userRow->related(UserRoleRepository::TABLE_NAME, UserRoleRepository::COLUMN_USER_ID)->fetch();

                $defaultValues[UserRoleRepository::COLUMN_ROLE_ID] = $roleRow ? $roleRow->{UserRoleRepository::COLUMN_ROLE_ID} : NULL;
            }
        }

        return $defaultValues;
    }

    /**
     * Vrací možné role uživatele
     *
     * @return array
     */
    private function getRoles()
    {
        return $this->roleRepository->findAll()->fetchPairs(RoleRepository::COLUMN_ID, RoleRepository::COLUMN_NAME);
    }
}

interface IUserEditFormFactory
{
    /**
     * @return UserEditForm
     */
    public function create();
}