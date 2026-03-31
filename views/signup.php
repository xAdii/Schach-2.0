<h1>Sign Up</h1>
<?php include './modules/navigation.php'; ?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br><br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  <br><br>
  <button type="submit" value="signup" name="action">Account erstellen</button>
</form>