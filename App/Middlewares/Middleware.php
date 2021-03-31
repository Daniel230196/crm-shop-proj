<?php

declare(strict_types = 1);

namespace App\Middlewares;

use Http\Request;

abstract class Middleware
{

    protected ?Middleware $next;

    abstract public function handle(Request $request);

    protected function then(Request $request)
    {
        $this->next->handle($request);
    }
    
}