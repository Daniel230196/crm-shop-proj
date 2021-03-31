<?php

declare(strict_types=1);

namespace Core;

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
        'PageController' => [
            'main',
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
     * @const CONTROLLER_NAMESPACE
     *
     */
    private const CONTROLLER_NAMESPACE = 'App\Controllers\\';


    /**
     * @param Request $request
     * @return array
     * @throws \ReflectionException
     */
    public function start(Request $request): array
    {
        $controller = self::CONTROLLER_NAMESPACE.$this->controllerName($request);
        $method = $this->method($request);

        if ((new \ReflectionClass($controller))->hasMethod($method) && (new \ReflectionMethod($controller,$method))->isPublic() ){
            $instance = new $controller($request);
            //$instance->$method();

            return [$instance, $method];
        }

        return [];
    }

    /**
     * Получить имя контроллера
     * @param Request $request
     * @return string
     */
    private function controllerName(Request $request): string
    {
        $name = explode('/',$request->uri)[1];


        if(strtolower($name) === 'main' || empty($name) || !$this->controllerCheck($name) ){
            return 'PageController';
        }

        return ucfirst(strtolower($name)).'Controller';
    }

    /**
     * Получить запрашиваемый метод контроллера
     * @param Request $request
     * @return string
     */
    private function method(Request $request): string
    {
        return explode('/',$request->uri)[2] ?? 'default';
    }

    /**
     * Проверить наличие соответствующего классу-контроллера файла
     * @param string $name
     * @return bool
     */
    private function controllerCheck(string $name): bool
    {
        $checkResults = [];
        foreach(self::CONTROLLER_PATHS as $path){
            $checkResults[] = file_exists($path.$name.'.php');
        }
        return in_array(true, $checkResults);
    }
}