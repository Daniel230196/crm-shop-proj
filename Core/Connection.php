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

    private static \PDO $pdo;

    private function __construct()
    {
        $conf = Config::database('mysql');

        try{
            self::$pdo = new \PDO($conf['host'],$conf['user'], $conf['password'], [\PDO::ATTR_EMULATE_PREPARES => true]);
        }catch (\PDOException $exception){
            echo $exception->getMessage();
            // TODO :: handle db exceptions 
        }
    }

    /**
     * Направляет все неизвестные классу методы в класс подключения к базе данных, с проверкой на существование
     * @param string $method Название метода
     * @param array $args Аргументы для метода
     */
    public function __call(string $method, array $args)
    {
        try {
            if ( (new ReflectionClass(self::$pdo))->hasMethod($method) && (new ReflectionMethod(self::$pdo, $method))->isPublic() ){
                return self::$pdo->$method(...$args);
            }
            throw new ConnectionException('Data method not found', 401);
        }catch(ReflectionException $exception){
            //TODO : handle
            echo $exception->getMessage();
            exit;
        }catch(ConnectionException $connectionException){
            //TODO : handle
            echo $connectionException->getMessage();
            exit;
        }
    }
}