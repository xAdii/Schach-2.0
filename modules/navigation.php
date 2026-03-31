<nav>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <ul>
            <button type="submit" name="nav" value="home">Home</button>
            <?= !isset($_SESSION['user']) ? '<button type="submit" name="nav" value="signup">Registrieren</button>' : '' ?>
            <?= !isset($_SESSION['user']) ? '<button type="submit" name="nav" value="login">Anmelden</button>' : '' ?>
            <?= isset($_SESSION['user']) ? '<button type="submit" name="nav" value="dashboard">Dashboard</button>' : '' ?>
        </ul>
    </form>
</nav>