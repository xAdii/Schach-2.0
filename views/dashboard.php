<?php
if (!isset($_SESSION['user'])) {
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
$user = $_SESSION['user'] ?? null;
?>

<h1>Dashboard</h1>
<?php include './modules/navigation.php'; ?>

<p>Willkommen, <strong><?= htmlspecialchars($user['name']) ?></strong>.</p>

<h2>Namen ändern</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="action" value="userUpdateName">
    <label for="username">Neuer Benutzername</label><br>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['name']) ?>" required>
    <br><br>
    <button type="submit">Name speichern</button>
</form>

<h2>Passwort ändern</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="action" value="userUpdatePassword">
    <label for="password">Neues Passwort</label><br>
    <input type="password" id="password" name="password" required>
    <br><br>
    <button type="submit">Passwort speichern</button>
</form>

<h2>Abmelden</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="action" value="userLogout">
    <button type="submit">Ausloggen</button>
</form>

<h2>Account löschen</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return confirm('Möchtest du deinen Account wirklich löschen?');">
    <input type="hidden" name="action" value="userDelete    ">
    <button type="submit">Account löschen</button>
</form>