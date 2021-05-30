<?php
declare(strict_types=1);


namespace Core\Routing;


use App\Controllers\Api\v1\LeadsController;
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

    protected static array $routes = [
        'GET' => 'read',
        'POST' => 'create',
        'PATCH' => 'update',
        'DELETE' => 'delete',
        LeadsController::class => [
            'test',
            'complex'
        ]
    ];

    protected static string $defaultController = LeadsController::class;

    public function getMiddlewares()
    {

    }

    public function controllerName(string $uri): string
    {
        $uriSegment = explode('/',preg_replace(self::URI_PATTERN, '', $uri))[1];
        return  static::$controllerNamespace . ucfirst(strtolower($uriSegment)) . 'Controller';
    }

    protected function method(string $requestMethod,string $requestUri): string
    {
        $method = static::$routes[$requestMethod] ?? 'default';

        if(preg_match('!api/v1/[\w]+/[\d]+/\w+!',$requestUri)){
            $methodCheck = explode('/', $requestUri)[5];
            $method = in_array($methodCheck, static::$routes[$this->controllerName]) ? $methodCheck : $method;
        }

        return $method;
    }
}