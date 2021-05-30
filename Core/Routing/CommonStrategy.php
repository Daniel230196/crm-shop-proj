<?php


namespace Core\Routing;


use App\Controllers\LoginController;
use App\Controllers\MainController;
use App\Controllers\PipelineController;
use App\Controllers\ResourceController;
use App\Controllers\UserController;
use Http\Request;

class CommonStrategy extends RoutingStrategy
{

    protected static array $controllerPaths = [
      ROOT_DIR . 'App/Controllers',
    ];

    protected static string $controllerNamespace = 'App\Controllers\\';

    protected static array $routes = [

        UserController::class => [],
        ResourceController::class => [],
        MainController::class => [
            'index',
            'login',
            'pipeline',
            'invoices'
        ],
        LoginController::class => [
            'auth',
            'logout'
        ],
        PipelineController::class => [
            'pipeline'
        ]

    ];

    protected static string $defaultController = MainController::class;

    protected function getMiddlewares()
    {
        // TODO: Implement getMiddlewares() method.
    }

    public function controllerName(string $uri): string
    {
        return $this->explodeUri($uri)[1] ?? static::$defaultController;
    }


    protected function method(string $requestMethod, string $requestUri): string
    {
        $method = $this->explodeUri($requestUri)[2] ?? null;

        if(!is_null($method)){
            return strpos($method, '?') ? stristr($method, '?', true) : $method ;
        }

        return 'default';
    }

    private function explodeUri(string $uri): array
    {
        return explode('/',$uri);
    }

}