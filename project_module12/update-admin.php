<?php include('modules/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1><br>
        <?php 
            // Get the id of selected Admin
            $id = $_GET['id'];

            // Create SQL query to get the details
            $sql = "SELECT * FROM admin WHERE id = $1"; 

            // Execute the Query
            $result = pg_query_params($conn, $sql, array($id)); 

            // Check whether the query is executed or not
            if($result !== false) {
                // Check whether the data is available or not
                if(pg_num_rows($result) === 1) {
                    $row = pg_fetch_assoc($result);
					if ($row !== false) {
						// Check if 'full_name' is set, otherwise set a default value
						$full_name = isset($row['full_name']) ? $row['full_name'] : '';

						// Check if 'username' is set, otherwise set a default value
						$username = isset($row['username']) ? $row['username'] : '';
					} else {
						// if $row is false set the default values for both fields
						$full_name = '';
						$username = '';
					} 
                } else {
                    // Redirect to the manage admin page
                    header('location: mange-admin.php');
                    exit();
                }

            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">

				<?php 
					// Ensure $full_name is defined before using it in the HTML
					$full_name = isset($full_name) ? $full_name : '';
					$username = isset($username) ? $username : '';
				?>
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo trim($id); ?> ">
                        <input type="submit" name="submit" value="Update Admin" class="btn-primary input">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    // Check whether the submit Button is clicked or not
    if(isset($_POST['submit'])) {
        // Get all the values from form to update
        $id = (int)trim($_POST['id']);
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // Create Sql query to update admin
        $sql = "UPDATE admin SET full_name = $1, username = $2 WHERE id = $3";

        // Execute the Query
        $result = pg_query_params($conn, $sql, array($full_name, $username, $id));

// // Check if the query was successful
        if ($result !== false) {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
    
            // Insert activity log after successful update
            $adminId = $_SESSION['admin_id'];  // the logged-in admin's ID
            $adminUsername = $_SESSION['admin_username']; // logged-in admin's username
            $activityDescription = "$admin_username Updated $id with new username: $username and new full name: $full_name ";
            $action = "update-admin";
    
            // Call log_activity function
            if (log_activity($conn, $adminId, $adminUsername, $activityDescription, $action) === false) {
                error_log("Failed to insert update activity log.");
            }
    
            header('location: manage-admin.php'); // Redirect to manage-admin page
            exit();
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            header('location: manage-admin.php');
            exit();
        }
    }
?>
<?php include('modules/footer.php') ?>