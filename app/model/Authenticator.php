<?php

namespace App\Model;

use App\Model\Repository\RoleRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\UserRoleRepository;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;

class Authenticator implements IAuthenticator
{

    /** @var UserRepository */
    private $userRepository;
    /** @var UserRoleRepository */
    private $userRoleRepository;

    public function __construct(UserRepository $userRepository, UserRoleRepository $userRoleRepository)
    {

        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * Autentikuje uživatele
     *
     * @param array $credentials
     * @return Identity
     * @throws AuthenticationException
     */
    function authenticate(array $credentials)
    {
        list($login, $password) = $credentials;

        $row = $this->userRepository->findByLogin($login);
        if(!$row){
            throw new AuthenticationException('Uživatel nebyl nalezen.');
        }

        $hash = md5($password);

        if ($hash !== $row->{UserRepository::COLUMN_PASSWORD})
        {
            throw new AuthenticationException('Nesprávné heslo.');
        }

        $userRoles = $row->related(UserRoleRepository::TABLE_NAME, UserRoleRepository::COLUMN_USER_ID)->fetchAll();
        foreach ($userRoles as $userRole)
        {
            $roles[] = $userRole->ref(RoleRepository::TABLE_NAME, UserRoleRepository::COLUMN_ROLE_ID)->{RoleRepository::COLUMN_NAME};
        }

        return new Identity($row->{UserRepository::COLUMN_ID}, $roles, $row);
    }
}