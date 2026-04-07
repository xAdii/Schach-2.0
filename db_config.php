<?php
$config = [];

if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === '::1') {
    $config = [
        'host' => 'localhost',
        'username' => 'schach_20',
        'password' => '',
        'database' => 'schach_20'
    ];
} else {
    $config = [
        'host' => 'rdbms.strato.de',
        'username' => 'dbu3396043',
        'password' => '%43fT(h3Drdjzv$%',
        'database' => 'dbs14903908'
    ];
}


$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['database']}",
        $config['username'],
        $config['password'],
        $options
    );
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
