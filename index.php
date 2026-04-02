<?php
// Session starten
session_start();

// DB config laden
require_once './db_config.php';

// Autoloader für Models, Controllers und Pieces
spl_autoload_register(function ($classname) {
    $paths = ['models/', 'controllers/', 'pieces/'];
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

$gameModel = new GameModel($pdo);
$gameController = new GameController($gameModel);
$gameController->handleRequest();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/base.css">
    <link rel="stylesheet" href="./styles/board.css">
</head>

<body>
    <?php
    include './modules/error.php';

    include './modules/redirects.php';
    ?>
</body>

</html>