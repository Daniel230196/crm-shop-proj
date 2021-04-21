<?php
declare(strict_types=1);

namespace Core;


use App\Config;
use Core\Exceptions\ConnectionException;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Services\Traits\SingletonTrait;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Class Connection
 * @package Core
 */
class Connection
{
    use SingletonTrait;

    private static \PDO $pdo;
    private static EntityManager $em;
    private static string $sourcePath = ROOT_DIR . 'App/Models';

    private function __construct()
    {
     /*   $confPdo = Config::database('mysql');

        try {

            self::$pdo = new \PDO($confPdo['host'], $confPdo['user'], $confPdo['password'], [\PDO::ATTR_EMULATE_PREPARES => true]);
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            // TODO :: handle db exceptions 
        }*/
    }

    /**
     * Направляет все неизвестные классу методы в класс подключения к базе данных, с проверкой на существование
     * @param string $method Название метода
     * @param array $args Аргументы для метода
     * @return mixed
     */
    public function __call(string $method, array $args)
    {
        try {
            if ((new ReflectionClass(self::$pdo))->hasMethod($method) && (new ReflectionMethod(self::$pdo, $method))->isPublic()) {
                return self::$pdo->$method(...$args);
            }
            throw new ConnectionException('Data method not found', 401);
        } catch (ReflectionException $exception) {
            //TODO : handle
            echo $exception->getMessage();
            exit;
        } catch (ConnectionException $connectionException) {
            //TODO : handle
            echo $connectionException->getMessage();
            exit;
        }
    }

    public static function getEntityManager()
    {
        $confEm = Setup::createAnnotationMetadataConfiguration(Config::database('EmConfig'));
        try {
            $connParams = DriverManager::getConnection(Config::database('mysql'));
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

    }


}