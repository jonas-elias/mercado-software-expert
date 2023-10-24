<?php

return [
    'connection' => 'pgsql',
    'host' => 'db-mercado',
    'dbname' => 'postgres',
    'port' => 5432,
    'user' => 'user',
    'password' => 'password',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_AUTOCOMMIT => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
];
