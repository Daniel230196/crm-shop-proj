<?php

declare(strict_types=1);

namespace App;

use Http\Request;
use Http\Kernel;
use Http\Response;

/**
 * Class Application
 * @package App
 * Класс, инициализирующий приложение
 */
class Application
{
    private array $instances = [];


    private function __construct()
    {
    }

    public static function start(): void
    {
        Config::init();
        $request = new Request();
        echo '<pre>';
        var_dump($request->headers);
        echo '</pre>';
        $kernel = new Kernel();
        $kernel->route($request)
            ->thruPipeline($request)
            ->handle($request)
            ->terminate();
    }

    private function makeRequest(): Request
    {
        //TODO: implement
    }
}