<?php
declare(strict_types=1);


namespace Core\Routing;


use Http\Request;

/**
 * Стратегия маршрутизации для v1 api
 * Class ApiV1Strategy
 * @package Core\Routing
 */
class ApiV1Strategy extends RoutingStrategy
{
    /**
     * Паттерн для регулярного выражения, определяющего стратегию роутинга
     */
    public const URI_PATTERN = "^api/v1/^";

    protected static array $controllerPaths = [
      ROOT_DIR . 'App/Controllers/v1'
    ];

    protected static string $controllerNamespace = 'App\Controllers\Api\v1\\';

    protected static array $options = [
        'GET' => 'read',
        'POST' => 'create',
        'PATCH' => 'update',
        'DELETE' => 'delete'
    ];

    public function getMiddlewares()
    {
        // TODO: Implement getMiddlewares() method.
    }

    public function controllerName(string $uri): string
    {
        $uri = explode('/',$uri);
        var_dump($uri[3]);
        return $uri[3];
    }

    protected function method(string $requestMethod,string $requestUri, string $controllerClass): string
    {
        $pattern = '/api/v1/';
        $uri = str_ireplace($requestUri,$pattern,'');
        return 'api/v1/method';
    }
}