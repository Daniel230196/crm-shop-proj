<?php
declare(strict_types=1);

namespace Core;


use App\Config;
use Core\Exceptions\ConnectionException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Services\Traits\SingletonTrait;

/**
 * Class Connection
 * @package Core
 */

class Connection
{
    use SingletonTrait;

    private function __construct()
    {
        $conf = Config::database('mysql');
        try{
            self::$instance = new \PDO($conf['host'],$conf['user'], $conf['password']);
        }catch (\PDOException $exception){
            echo $exception->getMessage();
            // TODO :: handle db exceptions 
        }
    }


    /**
     * Направляет все неизвестные классу методы в класс подключения к базе данных, с проверкой на существование
     * @param string $method Название метода
     * @param array $args Аргументы для метода
     * @throws ConnectionException 
     */
    public function __call(string $method, array $args)
    {
        try {
            if ( (new ReflectionClass(self::$instance))->hasMethod($method) && (new ReflectionMethod(self::$instance, $method))->isPublic() ){
                return self::$instance->$method(...$args);
            }else{
                throw new ConnectionException('Data method not found', 401);
            }
        }catch(ReflectionException $exception){
            //TODO : handle
            echo $exception->getMessage();
        }
    }
}