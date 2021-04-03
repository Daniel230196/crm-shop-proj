<?php
declare(strict_types=1);


namespace App\Models;

use App\Models\Collections;

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
    public function collection(): Collections\Collection
    {
        return static::getCollection(static::class);
    }
    /**
     * @param ?string $type
     * @return Collections\Collection
     */
    public static function getCollection(?string $type=null): ?Collections\Collection
    {
        //TODO: implement method
    }

    public function markDirty()
    {
        //TODO: this
    }

}