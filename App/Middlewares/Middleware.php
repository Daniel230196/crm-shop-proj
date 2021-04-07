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

    /**
     * Основной метод обработки запроса для настоящего Middleware
     * @param Request $request
     */
    abstract public function handle(Request $request);

    /**
     * Метод, который будет вызван посредником после handle
     * @param Request $request
     */
    protected function then(Request $request): void
    {
        if(!is_null($this->next)){
            $this->next->handle($request);
        }
    }

}