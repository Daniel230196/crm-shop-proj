<?php


namespace App\Controllers;


class PipelineController extends BaseController
{
    protected array $middleware = [

    ];

    public function pipeline()
    {
        $this->view('pipeline');
    }
    /**
     * @inheritDoc
     */
    public function default()
    {
        $this->pipeline();
    }
}