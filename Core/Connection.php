<?php
declare(strict_types=1);

namespace Core;


use App\Config;
use Services\Traits\SingletonTrait;

/**
 * Class Connection
 * @package Core
 */

class Connection
{
    use SingletonTrait;

    private string $test;

    private \PDO $pdo;


    private function __construct()
    {
        $conf = Config::database('mysql');
        try{
            $this->pdo = new \PDO($conf['host'],$conf['user'], $conf['password']);
        }catch (\PDOException $exception){
            echo $exception->getMessage();
        }
    }
}