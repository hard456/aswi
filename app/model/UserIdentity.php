<?php

namespace App\Model;

use Nette\Security\Identity;

/**
 * Rozšíření identity o jméno uživatele
 *
 * @package App\Model
 */
class UserIdentity extends Identity
{
    /** @property */
    public $username;

    public function __construct($id, $username, $roles = null, $data = null)
    {
        parent::__construct($id, $roles, $data);

        $this->username = $username;
    }

    /**
     * Vrací uživatelské jméno
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}