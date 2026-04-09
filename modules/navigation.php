<nav>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <ul>
            <button type="submit" name="nav" value="home" class="home">Startseite</button>
            <button type="submit" name="nav" value="anleitung" class="anleitung">Anleitung</button>
            <?php if (isset($_SESSION['user'])) : ?>
                <button type="submit" name="nav" value="play" class="play">Spielen</button>
                <button type="submit" name="nav" value="dashboard" class="dashboard">Dashboard</button>
                <button type="submit" name="action" value="userLogout" class="logout">Abmelden</button>
            <?php else: ?>
                <button type="submit" name="nav" value="login" class="login">Anmelden</button>
                <button type="submit" name="nav" value="signup" class="signup">Registrieren</button>
            <?php endif; ?>
        </ul>
    </form>
</nav>