<?php
    // authentication credentials for database connection
    $host = "localhost";
    $port = "5432";
    $dbname = "nepalSupermarket";
    $user = "postgres";
    $password = "default_value";

    // Connection String
    $dsn = "pgsql:host=$host;dbname=$dbname";

    try {
        // Session
        // $instance = new PDO($dsn,$user,$password);
        $pdo = new PDO($dsn,$user,$password);
        // Set an error alert
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Eco messages
        echo "Successfully connected to the database";
    } catch (PDOException $e) {
        echo "Connection Failed: " . $e->getMessage();
    }

?>