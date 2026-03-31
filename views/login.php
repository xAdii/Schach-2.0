	<h2>Anmelden</h2>
	<?php include './modules/navigation.php'; ?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<label for="username">Benutzername</label><br>
		<input type="text" id="username" name="username" required><br>
		<label for="password">Passwort</label><br>
		<input type="password" id="password" name="password" required><br>
		<input type="submit" value="Anmelden">
	</form>
