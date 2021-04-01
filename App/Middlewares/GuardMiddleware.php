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
<<<<<<< HEAD
        echo 'handle' . $request->uri;    
=======

>>>>>>> 93e3c6b08580883ffcca5e8446d50ea3c7ac4fa5
    }
}