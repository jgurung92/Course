<?php

// start session
session_start();

// Database Connection
$host = 'localhost';
$port = '5432';
$db = 'restaurant';
$user = 'postgres';
$password = '';


// Create connection to PostGres
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$password");

// validate the connection works.
if (!$conn) {
    die("Connection failed, try again" .pg_last_error());
}

// Get User Account Information
$username = $_POST['username'];
$password = $_POST['password'];

// SQL Query
$sql = "SELECT * FROM users WHERE username = $1";
$result = pg_query_params($conn, $sql, array($username));

if (pg_num_rows($result) > 0) {
    if(hash_equals($user['password'], crypt($password, $user['password']))) {

    }
}
?>