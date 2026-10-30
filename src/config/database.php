<?php

return [
    // Variáveis de ambiente vindas do Docker Compose (.env)
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT'),
    'dbname' => 'noesis',
    'user' => getenv('DB_USER'),
    'pass' => getenv('DB_PASS'),
    'charset' => 'utf8mb4',
];
