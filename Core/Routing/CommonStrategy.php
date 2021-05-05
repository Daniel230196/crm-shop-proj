<?php


namespace Core\Routing;


use Http\Request;

class CommonStrategy extends RoutingStrategy
{


    protected function getMiddlewares()
    {
        // TODO: Implement getMiddlewares() method.
    }

    public function controllerName(Request $uri): string
    {
        // TODO: Implement controllerName() method.
    }


    protected function method(Request $request, string $controllerClass): string
    {
        // TODO: Implement method() method.
    }

}