<?php

declare(strict_types=1);

namespace Http;

use Core\Router;

/**
 * Class Kernel
 * @package Http
 * Ядро процесса обработки запросов
 */
class Kernel
{
    public function __construct()
    {

    }

    public function handle(Request $request): Kernel
    {
        return $this;
    }

    public function route(Request $request): Kernel
    {
        $router = new Router();
        $router->start($request);

        return $this;
    }
}