<h1>Play</h1>
<?php include './modules/navigation.php';
$userBoards = $gameController->getUserGames();
$emptyBoards = $gameController->getEmptyGames();
?>

<h1>Spiele</h1>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="nav" value="play">
    <input type="hidden" name="action" value="createGame">
    <button type="submit" name="gameType" value="local" class="create_new_game">Lokales Spiel erstellen</button>
    <button type="submit" name="gameType" value="public" class="create_new_game">Öffentliches Spiel erstellen</button>
</form>

<div class="flex-parent">
    <div class="flex-child">
        <h2>Meine Spiele</h2>
        <?php foreach ($userBoards as $board) : ?>
            <p>Spiel ID: <?= $board['ID'] ?></p>
            <p>Weiß: <?= $userController->getUsernameByID($board['playerWhiteID']) ?></p>
            <p>Schwarz: <?= $userController->getUsernameByID($board['playerBlackID']) ?></p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="nav" value="play">
                <input type="hidden" name="boardID" value="<?= $board['ID'] ?>">
                <button type="submit" name="action" value="joinGame" class="join_game">Beitreten</button>
                <button type="submit" name="action" value="deleteGame" class="delete_game">Löschen</button>
            </form>
        <?php endforeach; ?>
    </div>
    <div class="flex-child">
        <h2>Offene Spiele</h2>
        <?php foreach ($emptyBoards as $board) : ?>
            <p>Spiel ID: <?= $board['ID'] ?></p>
            <p>Weiß: <?= $userController->getUsernameByID($board['playerWhiteID']) ?></p>
            <p>Schwarz: <?= $userController->getUsernameByID($board['playerBlackID']) ?></p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="nav" value="play">
                <input type="hidden" name="boardID" value="<?= $board['ID'] ?>">
                <button type="submit" name="action" value="joinGame" class="join_game">Beitreten</button>
            </form>
        <?php endforeach; ?>
    </div>
</div>