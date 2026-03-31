<?php
require_once '.db_config.php';

spl_autoload_register(function ($classname) {
    $paths = ['models/', 'controllers/'];
    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $classname . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$userModel = new UserModel($pdo);

$userController = new UserController($userModel);
$userController->handleRequest();

include './views/index.php';
