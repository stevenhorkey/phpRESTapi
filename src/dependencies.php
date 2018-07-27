<?php 

// Dependency injector container
$container = $app->getContainer();

// Function added to dependency container in order to log info to ../logs/app.log for debugging.
// $container['logger'] = function($c) {
//     $logger = new \Monolog\Logger('my_logger');
//     $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
//     $logger->pushHandler($file_handler);
//     return $logger;
// };

// Function added to dependency container in order to configure the database.
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

?>