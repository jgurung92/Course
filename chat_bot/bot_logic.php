<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

// Logic
if(isset($_POST['user_input'])) {
    $user_input = trim($_POST['user_input']);
    $stmt = $pdo->prepare("SELECT bot_response FROM chatbot_response WHERE user_query ILIKE :user_query");
    $stmt->execute([':user_query' => '%' . $user_input . '%']);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Conditional statement
    if ($result) {
        echo $result['bot_response'];
    } else {
        echo "Sorry, I didn't understand that.";
    }
};



?>

