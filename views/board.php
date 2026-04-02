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
    <?php
    for ($y = 0; $y < 8; $y++) {
        echo '<div class="row">';
        for ($x = 0; $x < 8; $x++) {
            echo '<div class="cell ' . (($x + $y) % 2 === 0 ? 'white' : 'black') . '">';
            if (isset($board[$y][$x]) && $board[$y][$x]) {
                echo '<img src="' . $board[$y][$x]->getImg() . '" alt="">';
            }
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
</div>