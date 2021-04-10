<?php
declare(strict_types=1);

namespace App\Models;


/**
 * Class UserMapper
 * @package App\Models
 */
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

    public function update(DomainModel $model): void
    {
        $this->updateStmt()->execute([$model->getId()]);
    }

    protected function selectStmt(): \PDOStatement
    {
        return $this->selectStmt;
    }

    protected function updateStmt(): \PDOStatement
    {
        return $this->updateStmt;
    }

    protected function doCreateObj(array $raw): DomainModel
    {
        $obj = new User($raw);

    }

    protected function doInsert(DomainModel $user): void
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
    public function checkUser(array $authData): ?int
    {
        $this->authStmt->execute($authData);
        $result = $this->authStmt->fetch();
        return is_array($result) ? $result['id'] : null;
    }
}