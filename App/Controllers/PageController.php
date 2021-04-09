<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middlewares\GuardMiddleware;

/**
 * Class PageController
 * @package App\Controllers
 */
class PageController extends BaseController
{
    protected array $middleware = [
        'pipeline|main' => [
            GuardMiddleware::class => ['admin', 'user'],
        ]
    ];

    private const VIEW_PATH = 'App/views/';

    public function main(): void
    {
        include self::VIEW_PATH.'index.php';
    }
    public function pipeline(): void
    {
        include self::VIEW_PATH.'pipeline.php';
    }
    public function login(): void
    {
        include self::VIEW_PATH.'login.php';
    }

    public function default()
    {
        $this->login();
    }
}