<?php

declare(strict_types=1);

namespace Core;


/**
 * Класс маршрутизации
 */
class Router
{
    /**
     * Доступные маршруты по контроллерам 
     * @const array
     */
    private const ROUTES = [
        'UserController' => [
            'login',
            'logout'
        ]
    ];

    public static function start()
    {
        
    }
}