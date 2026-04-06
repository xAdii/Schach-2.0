<?php
$errorMessage = '';

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'emptyFields':
            $errorMessage = 'Bitte fülle alle Felder aus.';
            break;
        case 'usernameTaken':
            $errorMessage = 'Benutzername ist bereits vergeben.';
            break;
        case 'userNotFound':
            $errorMessage = 'Benutzer nicht gefunden.';
            break;
        case 'wrongPassword':
            $errorMessage = 'Passwort nicht korrekt.';
            break;
        case 'invalidUsername':
            $errorMessage = 'Ungültiger Benutzername. Keine Leerzeichen erlaubt.';
            break;
        case 'invalidPassword':
            $errorMessage = 'Ungültiges Passwort. Keine Leerzeichen erlaubt.';
            break;
    }
}

if ($errorMessage !== '') {
    echo '<p class="error">' . htmlspecialchars($errorMessage) . '</p>';
}
