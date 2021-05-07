<?php


namespace Core\Routing;


use Http\Request;

class ApiV2Strategy extends RoutingStrategy
{
    public const URI_PATTERN = "^api/v2/^";

    protected static string $controllerNamespace = 'App\Controllers\Api\V2\\';

    protected static array $controllerPaths = [
        ROOT_DIR . '/App/Controllers/Api/v2'
    ];

    protected function getMiddlewares()
    {
        // TODO: Implement getMiddlewares() method.
    }

    public function controllerName(string $uri): string
    {
        return 'Api v2 controller name';
    }

    protected function method(Request $request, string $controllerClass): string
    {
        // TODO: Implement method() method.
    }
}