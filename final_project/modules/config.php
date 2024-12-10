<?php
    session_start();

    // Connection parameters
    $host = 'localhost';
    $port = '5432';
    $dbname = 'restaurant';
    $user = 'postgres';
    $db_password = '';  // Database password, if any

    // Connection string for PostgreSQL
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$db_password");

    // Check connection
    if ($conn===false) {
        die("Connection error: " . pg_last_error());
    }

?>



