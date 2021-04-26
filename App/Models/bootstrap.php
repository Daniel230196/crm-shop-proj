<?php
declare(strict_types=1);

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;


return Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(\Core\Connection::getEntityManager());
