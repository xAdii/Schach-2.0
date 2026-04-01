<?php
session_start();

require_once './db_config.php';

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
    if (isset($_SESSION['user'])) {
        echo '<p>Angemeldet als: ' . htmlspecialchars($_SESSION['user']['name']) . '</p>';
    }
    include './modules/error.php';

    if (isset($_POST['nav']) && $_POST['nav'] === 'signup') {
        include './views/signup.php';
    } else if (isset($_POST['nav']) && $_POST['nav'] === 'login') {
        include './views/login.php';
    } else if (isset($_POST['nav']) && $_POST['nav'] === 'play') {
        include './views/play.php';
    } else if (isset($_POST['nav']) && $_POST['nav'] === 'dashboard') {
        include './views/dashboard.php';
    } else if (isset($_POST['nav']) && $_POST['nav'] === 'anleitung') {
        include './views/anleitung.php';
    } else if (isset($_GET['nav']) && $_GET['nav'] === 'signup') {
        include './views/signup.php';
    } else if (isset($_GET['nav']) && $_GET['nav'] === 'login') {
        include './views/login.php';
    } else if (isset($_GET['nav']) && $_GET['nav'] === 'play') {
        include './views/play.php';
    } else if (isset($_GET['nav']) && $_GET['nav'] === 'dashboard') {
        include './views/dashboard.php';
    } else if (isset($_GET['nav']) && $_GET['nav'] === 'anleitung') {
        include './views/anleitung.php';
    } else {
        include './views/home.php';
    }
    ?>
</body>

</html>