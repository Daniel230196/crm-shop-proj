<?php
declare(strict_types=1);

namespace App\Models;


use Core\Connection;

abstract class Mapper
{
    protected static Connection $connection;

    public function __construct()
    {
        static::$connection = Connection::getInstance();
    }

    /**
     * Найти объект по ID
     * @param int $id
     * @return DomainModel|null
     */
    public function find(int $id): ?DomainModel
    {
        $this->selectStmt()->execute([$id]);
        $row = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor();

        if (! is_array($row) )  { return null; }
        if (!$row['id']){ return null; }
        return $this->createObj($row);
    }

    /**
     * @param array $raw
     * @return DomainModel
     */
    public function createObj(array $raw): DomainModel
    {
        return $this->doCreateObj($raw);
    }

    public function insert(DomainModel $model): bool
    {
        return $this->doInsert($model);
    }

    abstract public function update(DomainModel $model);
    abstract protected function selectStmt() : \PDOStatement;
    abstract protected function doCreateObj(array $raw): DomainModel;
    abstract protected function doInsert(DomainModel $model);

}