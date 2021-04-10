<?php


namespace App\Middlewares;


use Http\Request;
use Http\Response;
use Services\ServiceFactory;
use Services\SessionService;

class SessionMiddleware extends Middleware
{

    /**
     * @inheritDoc
     */
    public function __invoke(Request $request, Response $response)
    {
        $session = ServiceFactory::getService('Session');

        if ($session instanceof SessionService && $session->status() === PHP_SESSION_NONE) {
            $session->start()
                ->set('ip', $request->getIp());

            $request->setSession($session);
        }

        $this->then($request, $response);
    }
}