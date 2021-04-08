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

    private const VIEW_PATH = 'App/views/';

    public function index()
    {
        include self::VIEW_PATH.'main.php';
    }
    public function pipeline()
    {
        include self::VIEW_PATH.'pipeline.php';
    }
    public function login()
    {
        include self::VIEW_PATH.'login.php';
    }

    public function default()
    {
        $this->login();
    }
}