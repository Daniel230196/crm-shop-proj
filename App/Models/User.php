<?php

declare(strict_types=1);

namespace App\Models;

class User extends DomainModel
{
    /**
     * @var string $login
     */
    private string $login;

    /**
     * @var string $password
     */
    private string $password;

    /**
     * @var int $cathegory_id
     */
    private int $category_id;

    public function __construct(array $row)
    {

        $this->login = $row['login'];
        $this->password = $row['password'];
        $this->category_id = $row['category_id'];
        parent::__construct($row['id']);
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCategory_id(): int
    {
        return $this->category_id;
    }

    public function setCategory_id(int $id): void
    {
        $this->category_id = $id;
    }

}
