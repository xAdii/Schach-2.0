<h1>Play</h1>
<?php include './modules/navigation.php';
$boards = $gameController->getUserGames();
?>

<h1>Spiele</h1>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="nav" value="play">
    <button type="submit" name="action" value="createGame" class="create_new_game">Neues Spiel erstellen</button>
</form>

<div>
    <?php foreach ($boards as $board) : ?>
        <div>
            <p>Spiel ID: <?= $board['ID'] ?></p>
            <p>Weiß: <?= $board['playerWhiteID'] ?></p>
            <p>Schwarz: <?= $board['playerBlackID'] ?></p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="nav" value="play">
                <input type="hidden" name="boardID" value="<?= $board['ID'] ?>">
                <button type="submit" name="action" value="joinGame" class="join_game">Beitreten</button>
                <button type="submit" name="action" value="deleteGame" class="delete_game">Löschen</button>
            </form>

        </div>
    <?php endforeach; ?>
</div>