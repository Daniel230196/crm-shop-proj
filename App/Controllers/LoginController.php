<?php


namespace App\Controllers;


use Http\Request;
use Services\ServiceFactory;
use Services\SessionService;

class LoginController extends BaseController
{
    protected array $middleware = [

    ];

    public function auth(): void
    {
        $authService = ServiceFactory::getService('Auth');
        $authService->authUser($this->request);
    }

    public function logout(): void
    {
        $session = ServiceFactory::getService('Session');
        $session->destroy();
    }
    /**
     * @inheritDoc
     */
    public function default()
    {
        // TODO: Implement default() method.
    }
}