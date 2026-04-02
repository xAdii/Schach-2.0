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
    <input type="hidden" name="nav" value="dashboard">
    <label for="username">Neuer Benutzername</label><br>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['name']) ?>" required>
    <br><br>
    <button type="submit" class="update_name_password">Name speichern</button>
</form>

<h2>Passwort ändern</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="action" value="userUpdatePassword">
    <input type="hidden" name="nav" value="dashboard">
    <label for="old_password">Altes Passwort</label><br>
    <input type="password" id="old_password" name="old_password" required><br>    
    <label for="password">Neues Passwort</label><br>
    <input type="password" id="password" name="password" required>
    <br><br>
    <button type="submit" class="update_name_password">Passwort speichern</button>
</form>

<h2>Abmelden</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="hidden" name="action" value="userLogout">
    <input type="hidden" name="nav" value="dashboard">
    <button type="submit" class="logout">Ausloggen</button>
</form>

<h2>Account löschen</h2>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return confirm('Möchtest du deinen Account wirklich löschen?');">
    <input type="hidden" name="action" value="userDelete">
    <input type="hidden" name="nav" value="dashboard">
    <button type="submit" class="delete_account">Account löschen</button>
</form>