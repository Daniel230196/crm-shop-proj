<?php
declare(strict_types=1);


namespace Core\Routing;

abstract class RoutingStrategy
{
    protected static string $controllerNamespace;
    protected static array $routes;

    abstract protected function getMiddlewares();

    public function __construct()
    {

    }

}