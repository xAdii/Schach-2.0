<h1>Play</h1>
<?php include './modules/navigation.php';
$boards = getUserGames();
?>

<h1>Spiele</h1>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="action" value="createGame">
    <button type="submit">Neues Spiel erstellen</button>
</form>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="nav" value="play">
    <button type="submit">Alte Spiele anzeigen</button>
</form>

<div>
    <?php foreach ($boards as $board) : ?>
        <div>
            <p>Spiel ID: <?= $board['ID'] ?></p>
            <p>Weiß: <?= $board['playerWhiteID'] ?></p>
            <p>Schwarz: <?= $board['playerBlackID'] ?></p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="action" value="joinGame">
                <input type="hidden" name="boardID" value="<?= $board['ID'] ?>">
                <button type="submit">Beitreten</button>
            </form>

        </div>
    <?php endforeach; ?>
</div>