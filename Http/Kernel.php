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
    /**
     * Параметры маршрутизации для обработчика запроса
     * @var array
     */
    private array $routingParams;


    public function __construct()
    {

    }

    public function handle(Request $request): Kernel
    {

        return $this;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function route(Request $request): Kernel
    {
        $router = new Router();
        try{
            $this->routingParams = $router->start($request);
        }catch(\ReflectionException $e){

            //TODO: Handle exception
        }

        return $this;
    }


    public function thruPipeline(Request $request)
    {
        $pipeline = new Pipeline($request, $this->routingParams);
        $pipeline;
    }
}