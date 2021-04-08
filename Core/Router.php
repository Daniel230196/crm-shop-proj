<?php

declare(strict_types=1);

namespace Core;

use App\Controllers\BaseController;
use App\Controllers\MainController;
use App\Controllers\ResourceController;
use App\Controllers\UserController;
use App\Middlewares\Middleware;
use Core\Exceptions\RouteException;
use Http\Request;

class Router
{
    /**
     * Доступные маршруты по контроллерам
     * @const array ROUTES
     */
    private const ROUTES = [
        UserController::class => [],
        ResourceController::class => [],
        MainController::class => [
            'index',
            'login',
            'pipeline',
            'invoices'
        ],
    ];

    /**
     * Пути к файлам классов контроллера
     * @const array CONTROLLER_PATHS
     */
    private const CONTROLLER_PATHS = [
        'App/Controllers/',
        'App/Controllers/Api',
    ];

    /**
     * Инстанс и метод контроллера
     * @var array
     */
    private array $statement;
    /**
     * @const CONTROLLER_NAMESPACE
     *
     */
    private const CONTROLLER_NAMESPACE = 'App\Controllers\\';


    /**
     * @param Request $request
     * @return array
     * @throws \ReflectionException
     * @throws RouteException
     */
    public function start(Request $request): array
    {
        $controller = self::CONTROLLER_NAMESPACE . $this->controllerName($request);
        $method = $this->method($request, $controller);
        $instance = new $controller($request);
        $this->statement['controller'] = $instance;

        if ((new \ReflectionClass($controller))->hasMethod($method) && (new \ReflectionMethod($controller, $method))->isPublic()) {
            //$instance->$method();
            $this->statement = ['controller' => $instance, 'action' => $method];
            return $this->getMiddlewares($this->statement);
        }else{
            throw new RouteException('invalid controller method', 409);
        }

    }

    public function getStatement(): array
    {
        return $this->statement;
    }

    /**
     * Получить имя контроллера
     * @param Request $request
     * @return string
     */
    private function controllerName(Request $request): string
    {
        $name = $request->controller();
        $name = ucfirst(strtolower($name)) . 'Controller';

        if (!array_key_exists(self::CONTROLLER_NAMESPACE.$name, self::ROUTES) || empty($name) || !$this->controllerCheck($name)) {
            return 'MainController';
        }

        return $name;
    }

    /**
     * Получить запрашиваемый метод контроллера
     * @param Request $request
     * @param string $controllerClass
     * @return string
     */
    private function method(Request $request, string $controllerClass): string
    {
        $method = $request->action();
        if ($method && in_array($method,self::ROUTES[$controllerClass]) ){
            return $method;
        }
        return 'default';
    }

    /**
     * Проверить наличие файла с классом в соответствии с CONTROLLER_PATHS
     * @param string $name
     * @return bool
     */
    private function controllerCheck(string $name): bool
    {
        $checkResults = [];
        foreach (self::CONTROLLER_PATHS as $path) {
            $checkResults[] = file_exists($path . $name . '.php');
        }
        return in_array(true, $checkResults);
    }

    /**
     * Получить middleware в соответствии с методом контроллера
     * @param array $params
     * @return array|null
     * @trows RouteException
     */
    private function getMiddlewares(array $params): ?array
    {
        if (count($params) !== 2 || !($params['controller'] instanceof BaseController)) {
            throw new RouteException('invalid middleware params', 406);
        }

        $middleware = $params['controller']->middleware();

        if (!is_null($middleware)) {
            $result = [];
            foreach( $middleware as $key=>$state){
                $methodControl = explode('|' , $key );
                $class = array_keys($state);
                $params = array_values($state);
                if(in_array($params['action'], $methodControl) && is_array($params) && $class instanceof Middleware ){
                    $class::addParams($params);
                    $result[] = $class;
                }else{
                    continue;
                }
            }
            return $result;
        }

        return [];
    }

}