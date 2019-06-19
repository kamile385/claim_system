<?php

include '../db_connection.php';
include '../functions.php';

if (isset($_POST['login-btn'])) {
    $conn = OpenConnection();
    $username = $_POST['username'];
    $password = $_POST['password'];

//    $hash = crypt("supplier", 12);
//    var_dump($hash);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = selectFromDatabase($conn, $sql);
    if (!empty($result)) {
        while ($row = mysqli_fetch_assoc($result)) {

            if (password_verify($password, $row["password"])) { // if password matches
                // log user
                loginById($row["id"]);
            } else { // if password does not match
                $_SESSION['error_msg'] = "Neteisingi duomenys";
            }
        }
    } else { // if no user found
        $_SESSION['error_msg'] = "Neteisingi duomenys";
        var_dump($_SESSION['error_msg']);
    }
}
