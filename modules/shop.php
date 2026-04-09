<?php
echo '<h1>Shop</h1>';

$shopItems = [
    ['name' => 'Item 1', 'price' => 10],
    ['name' => 'Item 2', 'price' => 20],
    ['name' => 'Item 3', 'price' => 30]
];

echo '<div style="display:flex; gap:20px;">';

foreach ($shopItems as $item) {
    echo '<div style="width:150px; border:1px solid #ccc; padding:10px; text-align:center;">';
    echo '<div style="width:80px; height:80px; margin:0 auto 10px; background:#ddd; line-height:80px;">Bild</div>';
    echo '<strong>' . $item['name'] . '</strong><br>';
    echo 'Preis: ' . $item['price'] . ' Gold<br><br>';
    echo '<button>Kaufen</button>';
    echo '</div>';
}

echo '</div>';
?>