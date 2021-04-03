<?php
declare(strict_types=1);

namespace Services\Traits;

trait SingletonTrait
{
    protected static $instance;

    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance()
    {
        if (static::$instance === null ){
            static::$instance = new static();
        }
        return static::$instance;
    }


}