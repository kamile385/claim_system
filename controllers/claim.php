<?php

include '../db_connection.php';

if (isset($_POST['claim-btn'])) {
    $conn = OpenConnection();
    $text = $_POST['text'];

    $userId = $_SESSION['user']['id'];
    $sql = "INSERT INTO claim (text, fk_user) VALUES ('$text', '$userId')";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success" role="alert">
            Nauja pretezija sukurta
        </div>';
        header("Refresh:0");
    } else {
        echo "Klaida: " . $sql . "<br>" . $conn->error;
    }
    
}