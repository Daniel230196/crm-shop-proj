<?php
declare(strict_types=1);


namespace App\Controllers\Api;


use Doctrine\ORM\EntityManager;
use Http\Request;

class BaseApiController
{
    protected EntityManager $em;
    protected Request $request;
    protected array $middlewares;

    public function __construct()
    {
    }


}