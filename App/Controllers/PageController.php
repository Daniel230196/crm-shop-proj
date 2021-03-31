<?php

declare(strict_types = 1);

namespace App\Controllers;

use Http\Request;

class PageController extends BaseController
{ 
    protected $middleware;

    /**
     * Путь к view-файлам
     * @const VIEW_PATH
     */
    private const VIEW_PATH = __DIR__.'../views/';
    public function __construct(Request $request)
    {
        
    }
    
    public function render()
    {

    }
}