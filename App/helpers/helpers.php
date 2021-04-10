<?php
declare(strict_types=1);


namespace App\helpers;

function view(string $name, array $params = [])
{
    $viewFiles = scandir('../views');
    $name = $name . '.php';
    extract($params);
    include $name;
}

