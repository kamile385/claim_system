<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php
        include '../db_connection.php';
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            session_abort();
            exit('Klaida: Prieiga negalima');
        }
        else {
            include '../layouts/navbar.php';
            ?>
            <div class = "container">
                <div class = "row">
                    <div class = "col mt-4 mb-4">
                        <form action = "../templates/reply.php?id=<?php echo $_GET['id']; ?>" method="POST">
                            Atsakymas: <input type = "text" name = "text">
                            <input type = "submit" name = "reply-btn" value = "siųsti" class="btn btn-secondary">
                        </form>
                        <br>
                        <a href='admin.php'><input type = "submit" name = "reply-btn" value = "atgal" class="btn btn-danger"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_POST['reply-btn'])) {
        $conn = OpenConnection();
        $text = $_POST['text'];
        $userId = $_GET['id'];
        $sql = "INSERT INTO reply (text, fk_claim) VALUES ('$text', '$userId')";

        if (mysqli_query($conn, $sql)) {
            header('location: ' . BASE_URL . 'templates/admin.php');
            echo '<div class="alert alert-success" role="alert">
            Naujas atsakymas sukurtas
        </div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        CloseConnection($conn);
    }
}