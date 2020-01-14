<?php

use Phalcon\Config;

return new Config([

    'database' => [
        'adapter' => 'Phalcon\Db\Adapter\Pdo\Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'kptelkomsurat'
    ],
    'url' => [
        'baseUrl' => 'http://localhost/newtelkomsurat/'
    ]
]);