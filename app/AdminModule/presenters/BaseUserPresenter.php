<?php


namespace App\AdminModule\Presenters;

/**
 * Presenter používaný v administraci pro uživatele s právy editace
 *  kontroluje zda je uživatel Admin nebo uživatel s právy editace
 *
 * @package App\AdminModule\Presenters
 */
abstract class BaseUserPresenter extends BaseAdminPresenter
{
    /**
     * Část přístupná i uživatelům s právy editace
     *
     * @return bool
     */
    protected function isUserAllowed()
    {
        return $this->user->isLoggedIn()
            && ($this->user->isInRole(EUserRole::ADMIN) || $this->user->isInRole(EUserRole::USER));
    }
}