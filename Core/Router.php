<?php

declare(strict_types=1);

namespace Core;

use App\Controllers\BaseController;
use Core\Exceptions\RouteException;
use Http\Request;

class Router
{
    /**
     * Доступные маршруты по контроллерам
     * @const array ROUTES
     */
    private const ROUTES = [
        'UserController' => [],
        'ApiController' => [],
        'ResourceController' => [],
        'MainController' => [
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
        $method = $this->method($request);
        $instance = new $controller($request);
        $this->statement['controller'] = $instance;

        if ((new \ReflectionClass($controller))->hasMethod($method) && (new \ReflectionMethod($controller, $method))->isPublic()) {
            //$instance->$method();
            $this->statement = ['controller' => $instance, 'action' => $method];
            return $this->getMiddlewares($this->statement);
        }

        throw new RouteException('invalid controller method', 409);


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
        $name = explode('/', $request->uri)[1];


        if (empty($name) || strtolower($name) === 'main' || !$this->controllerCheck($name)) {
            return 'MainController';
        }

        return ucfirst(strtolower($name)) . 'Controller';
    }

    /**
     * Получить запрашиваемый метод контроллера
     * @param Request $request
     * @return string
     */
    private function method(Request $request): string
    {
        return $request->method() ?? 'default';
        //TODO: зарефакторить получение названия метода в Request
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
        return in_array(true, $checkResults, true);
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
            foreach( $middleware as $key=>$class){
                $methodControl = explode('|' , $key );
                if(in_array($params['action'], $methodControl, true)){
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