<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Application;
$test = 'www.test.loc/api/v45345/leads/12343423';
echo preg_match('*api/v4/*', $test);
Application::start();


