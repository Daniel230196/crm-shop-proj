<?php
declare(strict_types=1);

namespace App\Models\Factory;


use App\Models\Mapper;
use App\Models\Collections;

abstract class AbstractFactory
{

    public function __construct()
    {
    }

    abstract public static function getFinder(): Mapper;

    abstract public static function getCollection(array $row = [] , ?Mapper $mapper=null): Collections\Collection;
}