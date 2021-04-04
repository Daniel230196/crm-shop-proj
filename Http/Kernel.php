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

    /**
     * Дефолтные обработчики для каждого запроса
     * @var array
     */
    private array $middleware = [

    ];

    public function __construct()
    {

    }

    public function handle(Request $request): Kernel
    {

        return $this;
    }

    /**
     * Маршрутизация запроса , с сохранением параметров для дальнейшей обработки
     * @param Request $request
     * @return $this
     */
    public function route(Request $request): Kernel
    {
        $router = new Router();
        try{
            $this->routingParams = $router->start($request);
        }catch(\ReflectionException $e){
            exit();
            //TODO: Handle exception
        }

        return $this;
    }

    /**
     * Пропускает запрос через обработчики.
     * Метод должен быть вызыван после метода $this->route()
     * @param Request $request
     */
    public function thruPipeline(Request $request)
    {
        $pipeline = new Pipeline($request, $this->routingParams);
        $pipeline;
    }
}