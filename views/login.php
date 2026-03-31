<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Anmeldung</title>
</head>
<body>
	<?php include './modules/navigation.php'; ?>
	<h2>Anmelden</h2>
	<form action="../controllers/userController.php" method="post">
		<label for="username">Benutzername</label><br>
		<input type="text" id="username" name="username" required><br>
		<label for="password">Passwort</label><br>
		<input type="password" id="password" name="password" required><br>
		<input type="submit" value="Anmelden">
	</form>
</body>
</html>
