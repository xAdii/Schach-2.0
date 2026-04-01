<h1>Play</h1>
<?php include './modules/navigation.php'; ?>
<div class="board">
    <?php
    $board = [
        [],
        [new Placeholder('black', [1, 0]), new Placeholder('black', [1, 1]), new Placeholder('black', [1, 2]), new Placeholder('black', [1, 3]), new Placeholder('black', [1, 4]), new Placeholder('black', [1, 5]), new Placeholder('black', [1, 6]), new Placeholder('black', [1, 7])],
        [],
        [],
        [],
        [],
        [new Pawn('white', [6, 0]), new Pawn('white', [6, 1]), new Pawn('white', [6, 2]), new Pawn('white', [6, 3]), new Pawn('white', [6, 4]), new Pawn('white', [6, 5]), new Pawn('white', [6, 6]), new Pawn('white', [6, 7])],
        [new Rook('white', [7, 0]), new Knight('white', [7, 1]), new Bishop('white', [7, 2]), new Queen('white', [7, 3]), new King('white', [7, 4]), new Bishop('white', [7, 5]), new Knight('white', [7, 6]), new Rook('white', [7, 7])]
    ];

    for ($i = 0; $i < 8; $i++) {
        echo '<div class="row">';
        for ($j = 0; $j < 8; $j++) {
            $color = ($i + $j) % 2 === 0 ? 'white' : 'black';

            $img = '';
            if (isset($board[$i][$j])) {
                $piece = $board[$i][$j];
                $img = '<img src="' . $piece->getImg() . '" alt="Schachfigur">';
            }

            echo '<div class="field ' . $color . '">' . $img . '</div>';
        }
        echo '</div>';
    }
    ?>
</div>