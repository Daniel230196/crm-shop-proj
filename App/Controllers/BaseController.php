<?php

declare(strict_types = 1);

namespace App\Controllers;


use Closure;
use Http\Request;

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
 
    }

    public function middleware()
    {
        
    }
}