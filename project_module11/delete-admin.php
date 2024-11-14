
<?php

    // Include config file here for connection
    include('modules/config.php') ;
    // include('toggle.js');

    // 1. get the ID of Admin to be deleted.
    $id = intval($_GET['id']);

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM admin WHERE id = $id";

    // Execute the query
    $result = pg_query($conn, $sql);

    // Check wether the query executed successfully or not
    if($result !== false) {
        // Create Session variable to display the message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";




        // Insert activity log after successful update
        $adminUsername = $_SESSION['user']; // logged-in admin's username
        $activityDescription = "$adminUsername deleted admin_id $id with username: $username";
        $action = "delete-admin";
        

        // Call log_activity function
        if (log_activity($conn, $adminUsername, $activityDescription, $action) === false) {
            error_log("Failed to Delete Admin.");
        }


        // Redirect to Manage Admin page
        header("location: manage-admin.php");
    } else {
        // Create Session variable to display the message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later</div>";

        header("location: manage-admin.php"); //redirect the page to manage-admin
        exit();
    }
?>