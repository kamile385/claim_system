<?php
include 'config.php';

function OpenConnection(){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function selectFromDatabase($conn, $sql){
    $result = mysqli_query($conn, $sql);
    return $result;
}

function CloseConnection($conn){
    mysqli_close($conn);
}