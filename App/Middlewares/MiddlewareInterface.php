<?php


namespace App\Middlewares;


use Http\Request;
use Http\Response;

/**
 * Interface MiddlewareInterface
 * @package App\Middlewares
 */
interface MiddlewareInterface
{
    public static function addParams(array $params): void;
    public function __invoke(Request $request, Response $response);
}