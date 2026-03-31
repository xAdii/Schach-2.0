<?php // $user = $_SESSION['user'] ?? null; ?>
<?php include './modules/navigation.php'; ?>

<?php // if ($user): ?>
    <h1>Dashboard</h1>
    <p>Willkommen, <strong><?= htmlspecialchars($user['name']) ?></strong>.</p>

    <h2>Namen ändern</h2>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="action" value="update_name">
        <label for="username">Neuer Benutzername</label><br>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['name']) ?>" required>
        <br><br>
        <button type="submit">Name speichern</button>
    </form>

    <h2>Passwort ändern</h2>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="action" value="update_password">
        <label for="password">Neues Passwort</label><br>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Passwort speichern</button>
    </form>

    <h2>Abmelden</h2>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Ausloggen</button>
    </form>

    <h2>Account löschen</h2>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return confirm('Möchtest du deinen Account wirklich löschen?');">
        <input type="hidden" name="action" value="delete_account">
        <button type="submit">Account löschen</button>
    </form>


<?php // endif; ?>