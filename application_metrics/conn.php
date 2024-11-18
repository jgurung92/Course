<?php
session_start();

// Database connection
    $host = 'localhost';
    $port = '5432';
    $dbname = 'restaurant';
    $user = 'postgres';
    $password = ''; 

try {
    // Create a new PDO instance 
    $pdo = new PDO("pgsql:host = $host; port = $port; dbname = $dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
