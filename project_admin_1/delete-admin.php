

<?php
    // Include config file here for connection
    include('modules/config.php') ;

    // 1. get the ID of Admin to be deleted.
    echo $id = intval($_GET['id']);

    // 2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM admin WHERE id = $id";

    // Execute the query
    $result = pg_query($conn, $sql);

    // Check wether the query executed successfully or not
    if($result) {
        // Query executed Successfully and Admin deleted
        // echo "Admin Deleted Successfully";

        // Create Session variable to display the message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

        // Redirect to Manage Admin page
        header("location: manage-admin.php");
    } else {
        // Faild to delete Admin
        // echo "Failed to Delete Admin";

        // Create Session variable to display the message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later</div>";

        header("location: manage-admin.php"); //redirect the page to manage-admin
        exit();
    }
    
    
?>