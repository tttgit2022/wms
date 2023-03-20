<?php
    $host = "localhost";
    $username = "tlpkcom";
    $password = "yXI1zlLf2@2P2*";
    $database = "tlpkcom_royal_inventory";

    // Create DB Connection
    $con = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>