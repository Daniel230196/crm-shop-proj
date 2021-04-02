<?php
declare(strict_types=1);

namespace App\Models;


use Core\Connection;

abstract class Mapper
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function find(int $id)
    {
        $this->selectStmt()->execute([$id]);
        $row = $this->selectStmt()->fetch();
    }

    public function createObj(array $raw): DomainModel
    {
        return $this->doCreateObj($raw);

    }

    public function insert(DomainModel $model)
    {
        $this->doInsert($model);

    }

    abstract public function update(DomainModel $model);
    abstract protected function selectStmt() : \PDOStatement;
    abstract protected function doCreateObj(array $raw): DomainModel;
    abstract protected function doInsert(DomainModel $model);
    abstract protected function targetClass(): string;

}