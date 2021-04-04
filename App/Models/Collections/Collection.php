<?php

declare(strict_types=1);

namespace App\Models\Collections;

use App\Models\DomainModel;
use App\Models\Mapper;
use Core\Exceptions\OrmCollectionException;


/**
 * Базовый класс для объектов-коллекций
 */
abstract class Collection implements \Iterator
{

    protected ?Mapper $mapper;

    protected array $row;

    protected int $total = 0;


    private array $objects;
    private int $pointer;


    /**
     * Collection constructor.
     * @param array $row
     * @param Mapper|null $mapper
     * @throws OrmCollectionException
     */
    public function __construct(array $row = [], ?Mapper $mapper = null)
    {
        if( count($row) && is_null($mapper)){
            throw new OrmCollectionException();
        }
        $this->row = $row;
        $this->total = count($row);
        $this->mapper = $mapper;
    }

    /**
     * Добвить объект в коллекцию
     * @param DomainModel $object
     * @throws OrmCollectionException
     */
    public function add(DomainModel $object): void
    {
        $class = $this->targetClass();

        if (!($object instanceof $class)) {
            throw new OrmCollectionException();
        }

        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    /**
     * Получить указатель
     * @return int
     */
    public function key(): int
    {
        return $this->pointer;
    }

    /**
     * Сброс указателя
     */
    public function rewind(): void
    {
        $this->pointer = 0;
    }

    /**
     * Вернуть текущий элемент
     * @return DomainModel|mixed|null
     */
    public function current(): ?DomainModel
    {
        return $this->getRow($this->pointer);
    }

    /**
     * Следующий элемент
     */
    public function next()
    {
        $row = $this->row[$this->pointer];
        if($row) { $this->pointer++; }
        return $row;
    }


    /**
     * Проверка наличий текущего элемента
     * @return bool
     */
    public function valid(): bool
    {
        return (! is_null($this->current()) );
    }

    /**
     * Целевой класс
     * @return string
     */
    abstract protected function targetClass(): string;


    protected function notifyAccess()
    {
        // Реализация в дочерних классах 
    }

    /**
     * Получить объект по id
     * @param int $num
     * @return ?DomainModel
     */
    public function getRow(int $num): ?DomainModel
    {
        if ($num >= $this->total && $num <= 0) {
            return null;
        }

        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }

        if (isset($this->row[$num])) {
            $this->objects[$num] = $this->mapper->createObj($this->row[$num]);
            return $this->objects[$num];
        }

        return null;
    }
}
