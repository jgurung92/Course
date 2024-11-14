<?php 
include('modules/config.php');
include('modules/activity-log.php');
?>

<?php 
    // 1. Get the admin's username from the session
    $adminUsername = $_SESSION['user'];

    // 2. Create the activity description for logout
    $activityDescription = "$adminUsername logged out successfully.";
    $action = "logout"; 

    // Call log_activity function
    log_activity($conn, $adminUsername, $activityDescription, $action); 

    // 1. Distroy the session
    session_destroy(); //Unset $_SESSION and 'user'.

    // 2. Redirect to ligin page
    header("location: login.php");
