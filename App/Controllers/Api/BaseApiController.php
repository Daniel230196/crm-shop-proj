<?php
declare(strict_types=1);


namespace App\Controllers\Api;


use App\Controllers\ControllerInterface;
use Core\Connection;
use Doctrine\ORM\EntityManager;
use Http\Request;

class BaseApiController implements ControllerInterface
{
    protected EntityManager $em;
    protected Request $request;
    protected array $middlewares;

    public function __construct(request $request)
    {
        $this->request = $request;
        $this->em = Connection::getEntityManager();
    }

    public function create()
    {

    }

    public function read()
    {

    }

    public function update()
    {
        
    }

    public function delete()
    {

    }

    public function notFound()
    {

    }

    public function getMiddlewares()
    {

    }

    public function default()
    {
        // TODO: Implement default() method.
    }

    public function middleware(): array
    {
        return $this->middlewares;
    }
}