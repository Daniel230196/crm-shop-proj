<?php
declare(strict_types=1);


define('HOST','https://'.$_SERVER['HTTP_HOST']);
define('DEV_HOST', 'http://'.$_SERVER['HTTP_HOST']);
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']);
define('VIEW_PATH', ROOT_DIR . 'App/Views/');
define('VIEW_NAMESPACE', 'App\\Views\\');