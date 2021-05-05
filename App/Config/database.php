<?php


return [
  'mysql' => [
      'driver' => 'pdo_mysql',
      'dbname' => 'crm_admin',
      'user' => 'root',
      'password' => 'eyf89cp8',
      'host' => 'localhost',
  ],
    'doctrine' => [
        'driver' => 'pdo_mysql',
        'entityPath' => ROOT_DIR . '/App/Models/src',
        'isDevMode' => true,
        'proxyDir' => null,
        'cache' => null,
        'useSimpleAnnotationReader' => false
    ]
];