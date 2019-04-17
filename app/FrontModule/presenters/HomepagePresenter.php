<?php

namespace App\FrontModule\Presenters;

use App\FrontModule\Components\IExampleGirdFactory;
use App\FrontModule\Components\ILoginFormFactory;
use App\Enum\EFlashMessage;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    /** @var IExampleGirdFactory  */
    private $exampleGridFactory;
    /** @var ILoginFormFactory */
    private $loginFormFactory;

    public function __construct(IExampleGirdFactory $exampleGridFactory, ILoginFormFactory $loginFormFactory)
    {
        parent::__construct();

        $this->exampleGridFactory = $exampleGridFactory;
        $this->loginFormFactory = $loginFormFactory;
    }

    public function actionDefault()
    {

    }

    public function actionLogin()
    {
        if ($this->user->isLoggedIn())
        {
            $this->redirect('Homepage:default');
        }
    }

    public function actionLogout()
    {
        if ($this->getUser()->isLoggedIn())
        {
            $this->user->logout(true);

            $this->flashMessage('Odhlášení bylo úspěšné.', EFlashMessage::SUCCESS);
            $this->redirect('Homepage:default');
        }
    }

    /**
     * Komponenta přihlašovacího formuláře
     *
     * @return \App\FrontModule\Components\LoginForm
     */
    public function createComponentLoginForm()
    {
        return $this->loginFormFactory->create();
    }

    /**
     * Vytvoření ukázkového gridu
     */
    public function createComponentDataGrid()
    {
        return $this->exampleGridFactory->create();
    }
}
