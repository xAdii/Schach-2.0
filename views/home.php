<h1>Schach 2.0 - Index Page</h1>
<?php include './modules/navigation.php'; 
if (!isset($_SESSION['user'])) : ?>
    <p>Willkommen auf Schach 2.0! Bitte logge dich ein oder registriere dich, um zu spielen.</p>
<?php else : ?>
    <p>Willkommen zurück, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</p>
    <p>Du kannst jetzt ein neues Spiel erstellen oder einem bestehenden Spiel beitreten.</p>
<?php endif; ?> 