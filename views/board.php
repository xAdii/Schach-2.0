<h1>Spiel</h1>
<?php include './modules/navigation.php';
if (!isset($_SESSION['user'])) {
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
$user = $_SESSION['user'] ?? null;

$gameController->syncBoard();
$board = $_SESSION['board'] ?? null;
?>

<?php if (!$gameController->checkPlayersTurn() && !($gameController->checkPlayerWhite() && $gameController->checkPlayerBlack())) : ?>
    <script>
        setInterval(function() {
            fetch('<?= $_SERVER["PHP_SELF"] ?>?action=getTurn')
                .then(function(r) {
                    return r.text();
                })
                .then(function(turn) {
                    if (turn.trim() !== '<?= $gameController->getBoardTurn() ?>') {
                        location.reload();
                    }
                });
        }, 1000);
    </script>
<?php endif; ?>

<!-- Lokales Spiel: Spieler spielt gegen sich selbst, Spielbrett dreht sich nach jedem Zug -->
<?php if ($gameController->checkPlayerWhite() && $gameController->checkPlayerBlack()) : ?>
    <div class="board">
        <?php if ($gameController->getBoardTurn() === 'white') : ?>
            <?php for ($y = 0; $y < 8; $y++) : ?>
                <div class="row">
                    <?php for ($x = 0; $x < 8; $x++) : ?>
                        <?php include './modules/cell.php'; ?>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        <?php else : ?>
            <?php for ($y = 7; $y >= 0; $y--) : ?>
                <div class="row">
                    <?php for ($x = 7; $x >= 0; $x--) : ?>
                        <?php include './modules/cell.php'; ?>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>

    <!-- Online-Spiel: Spieler ist Weiß, Spielbrett dreht sich nicht -->
<?php elseif ($gameController->checkPlayerWhite() && !$gameController->checkPlayerBlack()) : ?>
    <div class="board">
        <?php for ($y = 0; $y < 8; $y++) : ?>
            <div class="row">
                <?php for ($x = 0; $x < 8; $x++) : ?>
                    <?php include './modules/cell.php'; ?>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Online-Spiel: Spieler ist Schwarz, Spielbrett dreht sich nicht -->
<?php elseif (!$gameController->checkPlayerWhite() && $gameController->checkPlayerBlack()) : ?>
    <div class="board">
        <?php for ($y = 7; $y >= 0; $y--) : ?>
            <div class="row">
                <?php for ($x = 7; $x >= 0; $x--) : ?>
                    <?php include './modules/cell.php'; ?>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<div class="row piece-shop-row">
    <?php // ist ne idee : foreach ($gameController->getPieceShop() as $piece) : 
    ?>
    <?php
    $newPieces = ['confusedpawn', 'gazelle', 'pony', 'prinzessin', 'thomas'];
    foreach ($newPieces as $piece) : ?>
        <img src="./images/white/<?php echo $piece; ?>.png" alt="Schachfigur" class="white piece-shop">
    <?php endforeach; ?>
</div>


<!-- Eventlistener nur aktivieren, wenn es der Spieler ist, der am Zug ist -->
<?php if ($gameController->checkPlayersTurn()) : ?>
    <script>
        document.querySelectorAll('.cell.valid, .cell.capture, .cell.selected').forEach(cell => {
            cell.addEventListener('click', () => {
                cell.querySelector('form').submit();
            });
        });

        document.querySelectorAll('.cell img.<?= $gameController->getBoardTurn() ?>').forEach(img => {
            img.addEventListener('click', () => {
                img.closest('form').submit();
            });
        });
    </script>
<?php endif; ?>