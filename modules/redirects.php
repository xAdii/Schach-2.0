<?php
if (isset($_POST['nav'])) {
    switch ($_POST['nav']) {
        case 'signup':
            include './views/signup.php';
            break;
        case 'login':
            include './views/login.php';
            break;
        case 'play':
            include './views/play.php';
            break;
        case 'game':
            include './views/game.php';
            break;
        case 'dashboard':
            include './views/dashboard.php';
            break;
        case 'anleitung':
            include './views/anleitung.php';
            break;
        default:
            include './views/home.php';
            break;
    }
} else if (isset($_GET['nav'])) {
    switch ($_GET['nav']) {
        case 'signup':
            include './views/signup.php';
            break;
        case 'login':
            include './views/login.php';
            break;
        case 'play':
            include './views/play.php';
            break;
        case 'game':
            include './views/game.php';
            break;
        case 'dashboard':
            include './views/dashboard.php';
            break;
        case 'anleitung':
            include './views/anleitung.php';
            break;
        default:
            include './views/home.php';
            break;
    }
} else {
    include './views/home.php';
}