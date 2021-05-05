<?php

declare(strict_types=1);


namespace App\Middlewares;

use Http\Request;
use Http\Response;

/**
 * Class GuardMiddleware
 * @package App\Middlewares
 * Проверка
 */
class GuardMiddleware extends Middleware
{

    public function __invoke(Request $request, Response $response)
    {
        // TODO: Implement __invoke() method.
        $this->then($request, $response);
    }
}