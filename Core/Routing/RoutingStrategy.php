<?php
declare(strict_types=1);


namespace Core\Routing;

use App\Controllers\ControllerInterface;

abstract class RoutingStrategy
{

    public const URI_PATTERN = '';
    /**
     * Пути к контроллерам
     * @var array
     */
    protected static array $controllerPaths = [];

    protected static string $defaultController;
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

    /**
     * Имя контроллера
     * @var string
     */
    protected string $controllerName;


    abstract protected function getMiddlewares();

    public function __construct(string $requestUri)
    {
        $this->controllerName = $this->controllerName($requestUri);
    }

    /**
     * Получить готовое имя класса контроллера
     * @param string $uri
     * @return ControllerInterface
     */
    public function controller(string $uri): ControllerInterface
    {
        if(!array_key_exists($this->controllerName, static::$routes) || !$this->controllerCheck($this->controllerName) ){
            return new static::$defaultController();
        }


        return new ${$this->controllerName}();
    }

    abstract protected function controllerName(string $uri): string;

    /**
     * Получить метод контроллера после всех проверок
     * @param string $requestMethod
     * @param string $requestUri
     * @return string
     */
    public function getMethod(string $requestMethod, string $requestUri): string
    {
        return $this->method($requestMethod, $requestUri);
    }


    abstract protected function method(string $requestMethod, string $requestUri): string;

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