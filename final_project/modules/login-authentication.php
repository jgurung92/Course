<?php 
    // Authorization - Access Control
    // Check whether the user is logged in or not
    if(!isset($_SESSION['user'])) {
        // User is not logged in
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Page</div>";
        // Redirect to Login page
        header("location: login.php");
    }
?>