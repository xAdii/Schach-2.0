<?php
$validMove = isset($_SESSION['validMoves']) && in_array([$y, $x], $_SESSION['validMoves']);
$captureMove = isset($_SESSION['captureMoves']) && in_array([$y, $x], $_SESSION['captureMoves']);
$blockedMove = isset($_SESSION['blockedMoves']) && in_array([$y, $x], $_SESSION['blockedMoves']);
$selectedPiece = isset($_SESSION['selectedPiece']) && $_SESSION['selectedPiece'] === [intval($y), intval($x)];
?>

<div class="cell 
    <?= ($x + $y) % 2 === 0 ? 'white' : 'black'; ?>
    <?= $validMove ? 'valid' : ''; ?>
    <?= $captureMove ? 'capture' : ''; ?>
    <?= $blockedMove ? 'blocked' : ''; ?>
    <?= $selectedPiece ? 'selected' : ''; ?>">

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="y" value="<?= $y; ?>">
        <input type="hidden" name="x" value="<?= $x; ?>">
        <?php if ($validMove) : ?>
            <input type="hidden" name="action" value="movePiece">
        <?php elseif ($captureMove) : ?>
            <input type="hidden" name="action" value="capturePiece">
        <?php elseif ($selectedPiece) : ?>
            <input type="hidden" name="action" value="selectCell">
        <?php elseif (isset($board[$y][$x]) && $board[$y][$x]) : ?>
            <input type="hidden" name="action" value="selectCell">
        <?php endif; ?>
        <div class="highlight-overlay">
            <?php if (isset($board[$y][$x]) && $board[$y][$x]) : ?>
                <img src="<?= $board[$y][$x]->getImg(); ?>" alt="Schachfigur">
            <?php endif; ?>
        </div>
    </form>
</div>