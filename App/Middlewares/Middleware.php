<?php

declare(strict_types = 1);

namespace App\Middlewares;

abstract class Middleware
{
    abstract public function handle();
}