<?php include('modules/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <?php 
            // Get the id of selected Admin
            $id = $_GET['id'];

            // Create SQL query to get the details
            $sql = "SELECT * FROM admin WHERE id = $1"; 

            // Execute the Query
            $result = pg_query_params($conn, $sql, array($id)); 

            // Check whether the query is executed or not
            if($result) {
                // Check whether the data is available or not
                if(pg_num_rows($result) == 1) {
                    $row = pg_fetch_assoc($result);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    // Redirect to the manage admin page
                    header('location: mange-admin.php');
                    exit();
                }

            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
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
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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

        // Check whether the query executed successfully or not 
        if($result) {
            // Query Executed and admin updated successfully
            $_SESSION ['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            header('location: manage-admin.php'); //redirect to manage-admin page
            exit();
        } else {
            // Failed to update admin
            $_SESSION ['update'] = "<div class='error'>Failed to Update Admin.</div>";
            header('location: manage-admin.php'); //redirect to manage-admin page
            exit();
        }
    }
    // Close PostgreSQL connection
    pg_close($conn);
?>
<?php include('modules/footer.php') ?>