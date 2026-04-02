<nav>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <ul>
            <button type="submit" name="nav" value="home" class="home">Home</button>
            <button type="submit" name="nav" value="anleitung" class="anleitung">Anleitung</button>
            <?= !isset($_SESSION['user']) ? '<button type="submit" name="nav" value="signup" class="signup">Registrieren</button>' : '' ?>
            <?= !isset($_SESSION['user']) ? '<button type="submit" name="nav" value="login" class="login">Anmelden</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="nav" value="play" class="play">Spielen</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="nav" value="dashboard" class="dashboard">Dashboard</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="action" value="userLogout"class="logout">Abmelden</button>' : '' ?>
        </ul>
    </form>
</nav>