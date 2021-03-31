<?php

declare(strict_types = 1);

namespace App\Middlewares;

use Http\Request;

abstract class Middleware
{
    /**
     * Метод обработки зарпроса
     * @param Request $request
     */
    abstract public function handle(Request $request);

    public function __invoke()
    {
        
    }
}