<?php

declare(strict_types = 1);

namespace App\Middlewares;

use Http\Request;

abstract class Middleware
{

    protected ?Middleware $next;


    public function __construct(?Middleware $next = null)
    {
        $this->next = $next;
    }

    abstract public function handle(Request $request);

    protected function then(Request $request): void
    {
        if(!is_null($this->next)){
            $this->next->handle($request);
        }
    }

}