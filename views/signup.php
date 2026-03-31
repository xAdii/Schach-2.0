<h1>Registrieren</h1>
<?php include './modules/navigation.php'; ?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <label for="username">Benutzername:</label>
  <input type="text" id="username" name="username">
  <br><br>
  <label for="password">Passwort:</label>
  <input type="password" id="password" name="password">
  <br><br>
  <button type="submit" value="userSignup" name="action">Registrieren</button>
</form>