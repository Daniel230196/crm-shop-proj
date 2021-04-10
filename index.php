<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require_once 'App/helpers/helpers.php';

use App\Application;
var_dump($_REQUEST);
Application::start();
