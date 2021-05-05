<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middlewares\GuardMiddleware;

/**
 * Class PageController
 * @package App\Controllers
 */
class MainController extends BaseController
{
    protected array $middleware = [
        'pipeline|index' => [
            GuardMiddleware::class => ['admin', 'user'],
        ]
    ];

    private const VIEW_PATH = 'App/templates/';

    public function index(): void
    {
        /*include self::VIEW_PATH.'main.php'*/;
        $this->view('Main');
    }
    public function pipeline(): void
    {
        include self::VIEW_PATH.'pipeline.php';
    }
    public function login(): void
    {
        $this->view('Login');
    }

    public function default()
    {
        //$this->login();
        $this->index();
    }
}