<?php
$shopItems = [
    ['name' => 'Item 1', 'price' => 10],
    ['name' => 'Item 2', 'price' => 20],
    ['name' => 'Item 3', 'price' => 30]
];
?>

<h2 class="shop-title">Shop</h2>

<div class="shop-grid">
    <?php foreach ($shopItems as $item): ?>
        <div class="shop-item">
            <div class="shop-image">Bild</div>
            <div class="shop-name"><?= htmlspecialchars($item['name']) ?></div>
            <div class="shop-price">Preis: <?= $item['price'] ?> Gold</div>
            <button class="shop-button">Kaufen</button>
        </div>
    <?php endforeach; ?>
</div>
