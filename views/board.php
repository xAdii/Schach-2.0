<h1>Spiel</h1>
<?php include './modules/navigation.php';
if (!isset($_SESSION['user'])) {
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
$user = $_SESSION['user'] ?? null;

$board = $_SESSION['board'] ?? null;
?>

<div class="board">
    <?php for ($y = 0; $y < 8; $y++) : ?>
        <div class="row">
            <?php for ($x = 0; $x < 8; $x++) : ?>
                <?php include './modules/cell.php'; ?>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

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