<?php

declare(strict_types=1);


namespace App\Middlewares;

use Http\Request;

/**
 * Class GuardMiddleware
 * @package App\Middlewares
 * Проверка
 */
class GuardMiddleware extends Middleware
{

    public function handle(Request $request)
    {
        echo 'handle' . $request->uri;    
    }
}