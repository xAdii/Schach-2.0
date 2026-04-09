<h1>Startseite</h1>
<?php include './modules/navigation.php';
if (!isset($_SESSION['user'])) : ?>
    <p>Willkommen auf Schach 2.0! Bitte logge dich ein oder registriere dich, um zu spielen.</p>
<?php else : ?>
    <h2>Willkommen!</h2>
    <p>Hallo, <em><?= htmlspecialchars($_SESSION['user']['name']); ?></em>! Du bist erfolgreich angemeldet.</p>
    <p>Du kannst jetzt ein neues Spiel erstellen oder einem bestehenden Spiel beitreten.</p>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="action" value="createGame">
        <button type="submit" name="gameType" value="public" class="create_new_game">Öffentliches Spiel erstellen</button>
    </form>
    <h2>Neu bei Schach 2.0?</h2>
    <p>Wenn du die Regeln von Schach noch nicht kennst, oder mehr über Power Ups, Hindernisse oder spezielle Spielfiguren erfahren möchtest, schau dir unsere Anleitung an.</p>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <button type="submit" name="nav" value="anleitung" class="anleitung">Zur Anleitung</button>
    </form>
<?php endif; ?>