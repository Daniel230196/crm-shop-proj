<?php


namespace App\Views;


class MainView extends View
{
    public function __construct(array $viewData = [])
    {
        parent::__construct($viewData);
    }

    public function renderTemplate()
    {
        include static::TEMP_PATH . 'main.php';
    }

}