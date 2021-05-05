<?php
declare(strict_types=1);


namespace Core\Routing;


use Http\Request;

class ApiV1Strategy extends RoutingStrategy
{
    protected static string $controllerNamespace = 'App\Controllers\Api\v1';
    protected static string $uriPattern = 'api/v1/';
    public function getMiddlewares()
    {
        // TODO: Implement getMiddlewares() method.
    }

    protected function controllerName(string $uri): string
    {

    }

    protected function method(Request $request, string $controllerClass): string
    {
        // TODO: Implement method() method.
    }
}