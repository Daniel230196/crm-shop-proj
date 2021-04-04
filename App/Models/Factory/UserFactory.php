<?php


namespace App\Models\Factory;


use App\Models\Collections;
use App\Models\Mapper;
use App\Models\UserMapper;
use Core\Exceptions\OrmCollectionException;

/**
 * Class UserFactory
 * Фабрика сущности пользователя
 * @package App\Models\Factory
 */
class UserFactory extends AbstractFactory
{

    public static function getFinder(): Mapper
    {
        return new UserMapper();
    }

    public static function getCollection(array $row = [], ?Mapper $mapper = null): Collections\Collection
    {
        try {
            return new \App\Models\Collections\UserCollection($row, $mapper);
        } catch (OrmCollectionException $e) {
            //TODO: handle exception
            exit();
        }
    }
}