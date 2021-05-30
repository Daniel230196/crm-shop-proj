<?php

declare(strict_types=1);

namespace Core\Routing;

use App\Controllers\BaseController;
use App\Controllers\LoginController;
use App\Controllers\MainController;
use App\Controllers\PipelineController;
use App\Controllers\ResourceController;
use App\Controllers\UserController;
use App\Middlewares\MiddlewareInterface;
use Core\Exceptions\RouteException;
use Http\Request;

class Router
{
    public const STRATEGIES = [
        ApiV1Strategy::URI_PATTERN => ApiV1Strategy::class ,
        ApiV2Strategy::URI_PATTERN => ApiV2Strategy::class
    ];

    /**
     * Доступные маршруты по контроллерам
     * @const array ROUTES
     */
    private const ROUTES = [

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
     * Стратегия для определения маршрутов
     * @var RoutingStrategy
     *
     */
    private RoutingStrategy $strategy;

    /**
     * Метод запроса
     * @var string
     */
    private string $requestMethod;


    public function __construct(string $requestUri, string $requestMethod)
    {
        $this->strategy = $this->getStrategy($requestUri);
    }

    /**
     * @param string $uri
     * @return array
     * @throws \ReflectionException
     * @throws RouteException
     */
    public function start(string $uri): array
    {
        $controller = $this->strategy->controller($uri);
        var_dump($controller);
        exit();
        $controller = self::CONTROLLER_NAMESPACE . $this->controllerName($request);
        $method = $this->method($request, $controller);
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
        $name = $this->strategy->controllerName($request->uri);
        $name = ucfirst(strtolower($name)) . 'Controller';

        if (!array_key_exists(self::CONTROLLER_NAMESPACE.$name, self::ROUTES) || empty($name) || !$this->controllerCheck($name)) {
            return 'MainController';
        }

        return $name;
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
     * @return array
     * @throws RouteException
     * @throws \ReflectionException
     */
    private function getMiddlewares(array $params): array
    {
        if (count($params) !== 2 || !($params['controller'] instanceof BaseController)) {
            throw new RouteException('invalid middleware params', 406);
        }

        $middleware = $params['controller']->middleware();
        if (!empty($middleware)) {
            $result = [];
            foreach( $middleware as $key=>$state){
                $methodControl = explode('|' , $key );
                $class = array_keys($state)[0];
                $middlewareParams = $state[$class];
                if(in_array($params['action'], $methodControl, true) &&
                    (new \ReflectionClass($class))->implementsInterface(MiddlewareInterface::class))
                {

                    $class::addParams($middlewareParams);
                    $result[] = $class;

                }else{
                    continue;
                }
            }
            return $result;
        }

        return [];
    }

    /**
     * Определение стратегии роутинга по паттерну роута api
     * @param string $uri
     * @return RoutingStrategy
     */
    private function getStrategy(string $uri): RoutingStrategy
    {
        $patterns = array_keys(self::STRATEGIES);
        $strategy = CommonStrategy::class;

        foreach ($patterns as $pattern){

            if(1 === preg_match($pattern, $uri)){
                $strategy = self::STRATEGIES[$pattern];
            }
        }

        return new $strategy();
    }

}