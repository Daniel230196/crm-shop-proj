<?php


namespace App\Controllers;


use Http\Request;
use Services\SessionService;

class LoginController extends BaseController
{
    protected array $middleware = [

    ];

    public function auth()
    {

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