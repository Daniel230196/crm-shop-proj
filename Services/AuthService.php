<?php

declare(strict_types = 1);

namespace Services;

use App\Models\Mapper;
use Http\Request;
use Http\Response;

/**
 * Класс-сервис авторизации
 */
class AuthService
{
    private Mapper $userMapper;

    public function __construct(Request $request, Response $response)
    {

    }

    private function validateInputForm()
    {

    }

    private function session()
    {
    }


}