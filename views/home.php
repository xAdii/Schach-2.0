<h1>Startseite</h1>
<?php include './modules/navigation.php';
if (!isset($_SESSION['user'])) : ?>
    <p>Willkommen auf Schach 2.0! Bitte logge dich ein oder registriere dich, um zu spielen.</p>
<?php else : ?>
    <p>Willkommen, <?= htmlspecialchars($_SESSION['user']['name']); ?>!</p>
    <p>Du kannst jetzt ein neues Spiel erstellen oder einem bestehenden Spiel beitreten.</p>
<?php endif; ?>