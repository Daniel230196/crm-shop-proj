<?php

declare(strict_types = 1);

namespace App\Controllers;

require_once 'App/helpers/helpers.php';

use App\Middlewares\GuardMiddleware;
use Closure;
use Core\Connection;
use Doctrine\ORM\EntityManager;
use Http\Request;
use function App\helpers\view;

/**
 * Class BaseController
 * @package App\Controllers
 */
abstract class BaseController
{
    /**
     * Массив обработчиков запроса контроллера
     * @var array
     */
    protected array $middleware;

    /**
     * @var EntityManager
     */
    protected EntityManager $em;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->em = Connection::getEntityManager();
    }

    public function middleware(): array
    {
        return $this->middleware;
    }

    /**
     * Метод будет вызван по дефолту
     * @return mixed
     */
    abstract public function default();

    /**
     * @param string $name
     * @param array|null $viewData
     */
    protected function view(string $name, ?array $viewData = [])
    {
        view($name, $viewData);
    }
}