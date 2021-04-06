<?php


namespace App\Models;


class UserMapper extends Mapper
{
    /**
     *
     */
    private \PDOStatement $selectStmt;
    private \PDOStatement $insertStmt;
    private \PDOStatement $updateStmt;
    private \PDOStatement $authStmt;

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

    protected function doCreateObj(array $raw): DomainModel
    {
        $obj = new User($raw);
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

    /**
     * @param array $values логин/пароль пользователя
     * @return ?array
     */
    public function checkUser(array $values) : ?array
    {
        $this->authStmt->execute($values);
        return $this->authStmt->fetch();
    }
}