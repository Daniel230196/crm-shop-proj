<?php


namespace App\Controllers;


use Http\Request;
use Services\ServiceFactory;
use Services\SessionService;

class LoginController extends BaseController
{
    protected array $middleware = [

    ];

    public function auth()
    {
        $authService = ServiceFactory::getService('Auth');
    }

    public function logout(Request $request)
    {

    }
    /**
     * @inheritDoc
     */
    public function default()
    {
        // TODO: Implement default() method.
    }
}