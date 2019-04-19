<?php


namespace App\AdminModule\Components;


use App\Model\Repository\UserRepository;
use App\Utils\DataGrid\DataGrid;
use Ublaboo\DataGrid\Exception\DataGridException;

class UserGrid extends DataGrid
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    /**
     * Abstraktní metoda, slouží k nastavení primárního klíče a nastavení datasource
     *  1. $this->setPrimaryKey();
     *  2. $this->setDataSource();
     *
     * @throws DataGridException
     */
    public function init()
    {
        $this->setPrimaryKey(UserRepository::COLUMN_ID);
        $this->setDataSource($this->userRepository->findAll());
    }

    /**
     * Definice sloupečků, akcí, vyhledávácích filtrů gridu
     *
     * @throws DataGridException
     */
    public function define()
    {
        // Definice sloupečků
        $this->addColumnNumber(UserRepository::COLUMN_ID, 'ID')->setDefaultHide(TRUE);
        $this->addColumnText(UserRepository::COLUMN_USERNAME, 'Uživatel');
        $this->addColumnText(UserRepository::COLUMN_LOGIN, 'Login');
        $this->addColumnText(UserRepository::COLUMN_EMAIL, 'Email');

        // Definice filtrů
        $this->addFilterText(UserRepository::COLUMN_USERNAME, 'Uživatel');
        $this->addFilterText(UserRepository::COLUMN_LOGIN, 'Login');
        $this->addFilterText(UserRepository::COLUMN_EMAIL, 'Email');

        // Akce
        $this->addAction('edit', 'upravit', 'User:edit', ['id' => UserRepository::COLUMN_ID])
            ->setTitle('Editovat');

        $this->addAction('delete', 'smazat', 'deleteUser!', ['id' => UserRepository::COLUMN_ID])
            ->setConfirm('Opravdu chcete uživatele "%s" odstranit?', UserRepository::COLUMN_LOGIN)
            ->setTitle('Odstranit')
            ->setClass('btn btn-xs btn-danger ajax');
    }
}

interface IUserGridFactory
{
    /**
     * @return UserGrid
     */
    public function create();
}