<?php
declare(strict_types=1);


namespace Core\Routing;

use Http\Request;

abstract class RoutingStrategy
{

    /**
     * Пути к контроллерам
     * @var array
     */
    protected static array $controllerPaths = [];

    /**
     * Пространство имён контроллеров
     * @var string
     */
    protected static string $controllerNamespace;

    /**
     * Доступные маршруты группы
     * @var array
     */
    protected static array $routes;

    abstract protected function getMiddlewares();

    public function __construct()
    {

    }

    /**
     * Получить готовое имя класса контроллера
     * @param string $uri
     * @return string
     */
    public function controller(string $uri): string
    {
        return static::$controllerNamespace . $this->controllerName($uri);
    }

    abstract protected function controllerName(string $uri): string;


    abstract protected function method(Request $request, string $controllerClass): string;

    /**
     * Проверка наличия контроллера в путях определенной стратегии
     * @param string $contrName
     * @return bool
     */
    protected function controllerCheck(string $contrName): bool
    {
        $checkResults = [];
        foreach (static::$controllerPaths as $path){
            $checkResults[] = file_exists($path . $contrName);
        }

        return in_array(true, $checkResults, true);
    }

}