<?php

declare(strict_types=1);

namespace App;

/**
 * Class Config
 * @package App
 * Класс конфигураций
 */
class Config
{
    /**
     * @const Путь к конфигам
     */
    private const CONFIG_PATH = 'App/Config';

    /**
     * Подключаемые при инициализации настройки
     * @var array
     * @return void
     */
    private static array $configs;

    public static function init(): void
    {
        $conf = scandir(self::CONFIG_PATH);

        array_map(function ($el) {
            if($el !== '.' && $el !== '..'){
                $position = strpos($el, '.php');
                $configName = substr($el,0, $position);

                $file = self::CONFIG_PATH.'/'.$el;
                self::$configs[$configName] = include $file ;

            }
        }, $conf);
    }

    /**
     * Магия - массив с настройками, вызвав метода по имени файла с настройками
     * @param string $method
     * @param array $args
     * @return array|null
     */
    public static function __callStatic(string $method, array $args): ?array
    {
        if(!array_key_exists($method,static::$configs)){
            return null;
        }

        if(count($args) === 1){
            return static::$configs[$method][$args[0]];
        }

        $res = [];
        foreach ($args as $arg){
            $res[$arg] = static::$configs[$method][$arg] ?? null;
        }
        return $res;
    }
}