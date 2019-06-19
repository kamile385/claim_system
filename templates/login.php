<?php include '../controllers/userLogin.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Prisijungimas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <?php include(INCLUDE_PATH . "/navbar.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 form-div">
                    <form action="login.php" method="POST">
                        <h4 class="text-center">Prisijungti</h4>
                        <div class="form-group">
                            <label for="username">Vartotojo vardas:</label>
                            <input type="text" name="username" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="password">Slaptažodis:</label>
                            <input type="password" name="password" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login-btn" class="btn btn-block btn-lg btn-login">Prisijungti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>