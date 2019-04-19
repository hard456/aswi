<?php


namespace App\Model\Facade;

use App\AdminModule\Components\UserEditForm;
use App\Model\Repository\UserRepository;
use App\Model\Repository\UserRoleRepository;
use Nette\Utils\ArrayHash;

class UserFacade
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserRoleRepository
     */
    private $userRoleRepository;

    public function __construct(UserRepository $userRepository,
                                UserRoleRepository $userRoleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * Uloží informace o uživateli do DB
     *
     * @param array $values : hodnoty z formuláře UserEditForm
     * @param int|null $userId : ID uživatele, pokud se edituje
     * @return bool|false|int|\Nette\Database\Table\ActiveRow
     */
    public function saveUser(array $values, int $userId = NULL)
    {
        $roleId = $values[UserRoleRepository::COLUMN_ROLE_ID];
        unset($values[UserRoleRepository::COLUMN_ROLE_ID]);
        unset($values[UserEditForm::PASSWORD_CONFIRM]);

        if (empty($values[UserRepository::COLUMN_PASSWORD]))
        {
            unset($values[UserRepository::COLUMN_PASSWORD]);
        } else
        {
            $values[UserRepository::COLUMN_PASSWORD] = md5($values[UserRepository::COLUMN_PASSWORD]);
        }

        if (!empty($userId))
        {
            $userRow = $this->userRepository->findById($userId)->fetch();

            if ($userRow)
            {
                $userRow->update($values);
            }

            $roleRow = $userRow->related(UserRoleRepository::TABLE_NAME, UserRoleRepository::COLUMN_USER_ID)->fetch();

            if ($roleRow)
            {
                $roleRow->update([UserRoleRepository::COLUMN_ROLE_ID => $roleId]);
            }
        } else
        {
            $userRow = $this->userRepository->insert($values);
            $this->userRoleRepository->addNew($userRow->{UserRepository::COLUMN_ID}, $roleId);
        }

        return $userRow;
    }

    /**
     * Odstraní uživatele
     *
     * @param int $userId
     * @return int
     */
    public function deleteUser(int $userId)
    {
        return $this->userRepository->delete($userId);
    }
}