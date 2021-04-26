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


    public function authUser(Request $request): void
    {
        /*$mapper = new UserMapper();
        $data = $request->post;
        if($data['login'] && $data['password'] ) {
            $user = $mapper->checkUser($data);
            if (is_null($user)) {
                header('Location:' . DEV_HOST . '/main/login', true, 301);
                exit();
            }

            $this->session->set('user', $user);
            header('Location:' . DEV_HOST . '/page/main', true, 301);
            exit();
        }*/

        //TODO : переделатьт метод под доктрину
    }


}