<?php


namespace App\Components;


use App\Enum\EFlashMessage;
use App\Model\Repository\UserRepository;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;

class LoginForm extends Control
{
    public function render()
    {
        $this->template->setFile(__DIR__ . '/LoginForm.latte');
        $this->template->render();
    }

    protected function createComponentForm()
    {
        $form = new Form;

        $form->addText(UserRepository::COLUMN_LOGIN, 'Login');
        $form->addPassword(UserRepository::COLUMN_PASSWORD, 'Password');

        $form->addSubmit('submit', 'Login');

        $form->onSuccess[] = [$this, 'formSuccess'];

        return $form;
    }

    public function formSuccess(Form $form)
    {
        $values = $form->getValues();

        try
        {
            $this->presenter->user->login($values->{UserRepository::COLUMN_LOGIN}, $values->{UserRepository::COLUMN_PASSWORD});
        } catch (AuthenticationException $ex)
        {
            $this->presenter->flashMessage($ex->getMessage(), EFlashMessage::ERROR);
            $this->presenter->redirect('Homepage:login');
        }

        $this->presenter->flashMessage('Přihlášení bylo úspěšné.', EFlashMessage::SUCCESS);
        $this->presenter->redirect('Homepage:default');
    }
}

interface ILoginFormFactory
{
    /**
     * @return LoginForm
     */
    public function create();
}