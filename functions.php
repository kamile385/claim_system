<?php

function loginPage($user_id, $user_role) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id='$user_id' AND role='$user_role' LIMIT 1";
    $user = selectFromDatabase($conn, $sql);
    if (!empty($user)) {
        while ($row = mysqli_fetch_assoc($user)) {
            if($row["role"] == 'admin'){
                header('location: ' . BASE_URL . 'templates/admin.php');
            }
            if($row["role"] == 'buyer'){
                header('location: ' . BASE_URL . 'templates/buyer.php');
            }
            if($row["role"] == 'supplier'){
                header('location: ' . BASE_URL . 'templates/supplier.php');
            }
        }
    }
}

function loginById($user_id) {
    global $conn;
    $sql = "SELECT id, username, role FROM users WHERE id='$user_id' LIMIT 1";
    $user = selectFromDatabase($conn, $sql);
    if (!empty($user)) {
        while ($row = mysqli_fetch_assoc($user)) {
            $_SESSION['user'] = $row;
            $_SESSION['success_msg'] = "Sėkmingai prisijungta";

            loginPage($row["id"], $row["role"]);
            exit(0);
        }
    }
}