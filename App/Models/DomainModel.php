<?php
declare(strict_types=1);


namespace App\Models;

use Cassandra\Collection;

/**
 * Class DomainModel
 * @package App\Models
 */
abstract class DomainModel
{
    /**
     * @var int $id
     */
    private int $id;

    /**
     * DomainModel constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $type
     * @return Collection
     */
    public static function getCollection(string $type): Collection
    {
        return Collection::getCollection($type);
    }

    public function markDirty()
    {
        //TODO: this
    }

}