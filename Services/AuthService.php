<?php

declare(strict_types = 1);

namespace Services;

use Http\Request;

/**
 * Класс-сервис авторизации
 */
class AuthService
{
    private SessionService $session;

    public function __construct(SessionService $sessionService)
    {
        $this->session = $sessionService;
    }

    public function test()
    {
        echo 'test';
    }
}