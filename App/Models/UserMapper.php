<?php


namespace App\Models;


class UserMapper extends Mapper
{
    private $selectStmt;
    private $insertStmt;
    private $updateStmt;
    private $authStmt;

    public function __construct()
    {
        parent::__construct();

        $this->authStmt = static::$connection->prepare(
            'SELECT *FROM users WHERE login=?,password=?'
        );
        $this->selectStmt = static::$connection->prepare(
            'SELECT * FROM users WHERE id=?'
        );
        $this->updateStmt = static::$connection->prepare(
            'UPDATE users SET login=?,password=?,cathegory_id=? WHERE id=?'
        );
        $this->insertStmt = static::$connection->prepare(
            'INSERT INTO users (login,password) VALUES (?,?)'
        );
    }

    public function update(DomainModel $model)
    {
        return $this->updateStmt;
    }

    protected function selectStmt(): \PDOStatement
    {
        return $this->selectStmt;
    }

    protected function doCreateObj(array $row): DomainModel
    {
        $obj = new User($row);
    }

    protected function doInsert(DomainModel $user)
    {
        $values = [
          $user->getLogin(),
          $user->getPassword(),
          $user->getCategory_id(),
          $user->getId()
        ];
        $this->insertStmt->execute($values);
    }

    public function checkUser($values): bool
    {
        return $this->authStmt->execute($values);
    }
}