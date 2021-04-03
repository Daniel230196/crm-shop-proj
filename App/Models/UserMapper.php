<?php


namespace App\Models;


class UserMapper extends Mapper
{
    private $selectStmt;
    private $insertStmt;
    private $updateStmt;

    public function __construct()
    {
        parent::__construct();

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

    protected function doInsert(DomainModel $model)
    {
        return $this->insertStmt;
    }
}