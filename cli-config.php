<?php
declare(strict_types=1);

use Doctrine\ORM\Tools\Console\ConsoleRunner;
chdir('App/Models');
// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = \Core\Connection::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
