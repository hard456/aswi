<?php


namespace App\AdminModule\Presenters;


use App\AdminModule\Components\IUserEditFormFactory;
use App\AdminModule\Components\IUserGridFactory;
use App\Model\Facade\UserFacade;

class UserPresenter extends BaseAdminPresenter
{
    /**
     * @var IUserGridFactory
     */
    private $userGridFactory;
    /**
     * @var IUserEditFormFactory
     */
    private $userEditFormFactory;
    /**
     * @var UserFacade
     */
    private $userFacade;

    public function __construct(IUserGridFactory $userGridFactory,
                                IUserEditFormFactory $userEditFormFactory,
                                UserFacade $userFacade
    )
    {
        parent::__construct();

        $this->userGridFactory = $userGridFactory;
        $this->userEditFormFactory = $userEditFormFactory;
        $this->userFacade = $userFacade;
    }

    public function actionAdd(){}

    public function actionEdit(int $id)
    {
        $this['userEditForm']->setUser($id);
    }

    public function handleDeleteUser(int $id)
    {
        if ($this->isAjax())
        {
            $this->userFacade->deleteUser($id);
            $this['userGrid']->reload();
        }
    }

    public function createComponentUserGrid()
    {
        return $this->userGridFactory->create();
    }

    public function createComponentUserEditForm()
    {
        return $this->userEditFormFactory->create();
    }
}