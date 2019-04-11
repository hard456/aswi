<?php

namespace Model;

use Model\Repository\UserRepository;
use Model\Repository\UserRoleRepository;
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
        list($username, $password) = $credentials;

        $row = $this->userRepository->findByUsername($username);
        if(!$row){
            throw new AuthenticationException('Uživatel nebyl nalezen.');
        }

        $hash = md5($password);

        if ($hash !== $row->{UserRepository::COLUMN_PASSWORD})
        {
            throw new AuthenticationException('Nesprávné heslo.');
        }

        $roles = $row->related(UserRoleRepository::TABLE_NAME, UserRoleRepository::COLUMN_USER_ID)
            ->fetchField(UserRoleRepository::COLUMN_ROLE_ID);

        return new Identity($row->{UserRepository::COLUMN_ID}, $roles);
    }
}