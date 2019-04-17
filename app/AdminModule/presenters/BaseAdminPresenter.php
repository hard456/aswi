<?php


namespace App\AdminModule\Presenters;

use App\Enum\EUserRole;
use Nette;

/**
 * Základní presenter od kterého dědí všechny presentery v AdminModulu,
 *  zajišťuje kontrolu práv uživatele
 *
 * @package App\AdminModule\Presenters
 */
abstract class BaseAdminPresenter extends Nette\Application\UI\Presenter
{

    public function startup()
    {
        parent::startup();

        if (!$this->isUserAllowed())
        {
            throw new Nette\Application\ForbiddenRequestException();
        }
    }

    /**
     * Vrací TRUE pokud má uživatel přístup do administrace
     *
     * @return bool
     */
    protected function isUserAllowed()
    {
        return $this->user->isLoggedIn() && $this->user->isInRole(EUserRole::ADMIN);
    }
}