<?php

declare(strict_types=1);

namespace Http;

use Core\Exceptions\RouteException;
use Core\Router;

/**
 * Class Kernel
 * @package Http
 * Ядро процесса обработки запросов
 */
class Kernel
{
    /**
     * Сущность ответа сервера
     * @var Response
     */
    private Response $response;

    /**
     * Инстанс контроллера и его метод
     * @var array
     */
    private array $routeAction;

    /**
     * Дефолтные обработчики для каждого запроса
     * @var array
     */
    private array $middleware = [

    ];

    /**
     * Обработчики запросов полученные при маршрутизации
     * @var array
     */
    private array $routeMiddleware = [];

    public function __construct()
    {
        $this->response = new Response('ok');
    }

    public function handle(Request $request): Kernel
    {
        //TODO: реализовать резрешение routeAction в response , добавить проверку запроса на наличие специфических заголовков, обработать нужным образом, сформировать ответ

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
            $this->routeMiddleware = $router->start($request);
            $this->routeAction = $router->getStatement();
        }catch(\ReflectionException $e){
            echo $e->getMessage();
            exit();
            //TODO: Handle exception
        }catch (RouteException $routeEx){
            echo $routeEx->getMessage();
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
    public function thruPipeline(Request $request): Kernel
    {
        $middlewares = array_merge($this->middleware, $this->routeMiddleware);

        if (!empty($this->routingParams)) {

            foreach ($middlewares as $key=>$middleware){
                $next = $this->middleware[$key + 1] ?? null;
                $instance = $next ? new $middleware(new $next()) : new $middleware(null);
                //TODO: реализовать формирование списка middleware
            }
        }

        return $this;
    }
}