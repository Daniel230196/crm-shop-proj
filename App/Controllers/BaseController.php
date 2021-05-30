<?php

declare(strict_types = 1);

namespace App\Controllers;

require_once 'App/helpers/helpers.php';

use App\Middlewares\GuardMiddleware;
use Core\Connection;
use Doctrine\ORM\EntityManager;
use Http\Request;
use function App\helpers\view;

/**
 * Class BaseController
 * @package App\Controllers
 */
abstract class BaseController implements ControllerInterface
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
     */
    public function __construct()
    {
        $this->em = Connection::getEntityManager();
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
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