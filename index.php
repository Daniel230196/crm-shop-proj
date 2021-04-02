<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\Application;
echo 'test';



Application::start();
$test = \Core\Connection::getInstance();
