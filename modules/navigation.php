<nav>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <ul>
            <button type="submit" name="nav" value="home">Home</button>
            <button type="submit" name="nav" value="anleitung">Anleitung</button>
            <?= !isset($_SESSION['user']) ? '<button type="submit" name="nav" value="signup">Registrieren</button>' : '' ?>
            <?= !isset($_SESSION['user']) ? '<button type="submit" name="nav" value="login">Anmelden</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="nav" value="play">Spielen</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="nav" value="dashboard">Dashboard</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="action" value="userLogout">Abmelden</button>' : '' ?>
        </ul>
    </form>
</nav>