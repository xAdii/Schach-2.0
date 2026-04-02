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
                <div class="cell <?= ($x + $y) % 2 === 0 ? 'white' : 'black'; ?>">
                    <div class="highlight 
                    <?= isset($_SESSION['validMoves']) && in_array([$y, $x], $_SESSION['validMoves']) ? 'valid' : ''; ?>
                    <?= isset($_SESSION['captureMoves']) && in_array([$y, $x], $_SESSION['captureMoves']) ? 'capture' : ''; ?>
                    <?= isset($_SESSION['blockedMoves']) && in_array([$y, $x], $_SESSION['blockedMoves']) ? 'blocked' : ''; ?>">
                        <?php if (isset($board[$y][$x]) && $board[$y][$x]) : ?>
                            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="hidden" name="action" value="selectCell">
                                <input type="hidden" name="y" value="<?= $y; ?>">
                                <input type="hidden" name="x" value="<?= $x; ?>">
                                <img src="<?= $board[$y][$x]->getImg(); ?>" alt="Schachfigur">
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

<script>
    document.querySelectorAll('form img').forEach(img => {
        img.addEventListener('click', () => {
            img.parentElement.submit();
        });
    });
</script>