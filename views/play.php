<h1>Play</h1>
<?php include './modules/navigation.php'; ?>
<div class="board">
    <?php
    for ($i = 0; $i < 8; $i++) {
        echo '<div class="row">';
        for ($j = 0; $j < 8; $j++) {
            $color = ($i + $j) % 2 === 0 ? 'white' : 'black';
            if ($i == 3) {
                echo '<div class="field ' . $color . '"><img src="./images/placeholder.png" alt="Placeholder"></div>';
            } else {
                echo '<div class="field ' . $color . '"></div>';
            }
        }
        echo '</div>';
    }
    ?>
</div>