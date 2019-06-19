<?php

include('config.php');

session_start(); // start session
define('BASE_URL', 'http://localhost:8081/claim_system/'); //home page
define('INCLUDE_PATH', realpath(dirname(__FILE__) . '/layouts')); // path to includes folder

function OpenConnection() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function selectFromDatabase($conn, $sql) {
    $result = mysqli_query($conn, $sql);
    return $result;
}

function CloseConnection($conn) {
    mysqli_close($conn);
}
