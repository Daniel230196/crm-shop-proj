<?php

declare(strict_types = 1);

namespace App\Controllers;

class UserController extends BaseController
{
    protected $middleware = [
        'auth' => AuthService::class
    ];

    public function default()
    {
        
    }
}