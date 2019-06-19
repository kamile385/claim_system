<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION["user"])): ?>
                <div class="dropdown show">
                    <?php echo '<h4 style="color:white">' . $_SESSION["user"]["username"] . '</h4>' ?>

                    <a href="<?php echo BASE_URL . 'templates/logout.php' ?>" style="color: red;">Logout</a>
                </div>
            <?php else: ?>
                <li><a href="<?php echo BASE_URL . 'templates/login.php' ?>"><span class="glyphicon glyphicon-log-in"></span> Prisijungti</a></li>
                <?php endif; ?>
        </div>
    </div>
</nav>