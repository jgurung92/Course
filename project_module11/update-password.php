<?php include('modules/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>
        <?php 
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
				$id = '';
			}
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

$adminId = $_SESSION['admin_id'];         // Admin's ID from session
$adminUsername = $_SESSION['admin_username']; // Admin's username from session

// Log the password update activity
$activityDescription = "Admin updated their password";
$action = "update";

insertActivityLog($activityDescription, $adminId, $adminUsername, $action);




    // Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit'])) {
        // 1. Get the Data from Form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. Check whether the user with current ID and Current Password Exists or not
        $sql = "SELECT * FROM admin WHERE id = $1 AND password = $2";
        
        // Execute the Query with parameters
        $result = pg_query_params($conn, $sql, array($id, $current_password));

        if($result !== false) {
            // Check whether data is available or not
            $count = pg_num_rows($result);
            if($count === 1) {
                // Check whether the new password and confirm match or not
                if($new_password === $confirm_password) {
                    // Update Password
                    $sql2 = "UPDATE admin SET password = $1 WHERE id = $2";
                    // Execute the Update Query with parameters
                    $result2 = pg_query_params($conn, $sql2, array($new_password, $id));
                    // Check whether the query executed successfully
                    if($result2 !== false) {
                        // Redirect to Manage Admin with Success Message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                        header('location: manage-admin.php');
                        exit();
                    } else {
                        // Redirect to Manage Admin with Error Message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                        header('location: manage-admin.php');
                        exit();
                    }
                } else {
                    // Redirect to Manage Admin Page with Error Message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Not Match. </div>";
                    header('location: manage-admin.php');
                    exit();
                }
            } else {
                // User does not exist, set Message and Redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                header('location: manage-admin.php');
                exit();
            }
        } else {
            // If query failed, set a generic error message
            $_SESSION['change-pwd'] = "<div class='error'>An error occurred. Please try again later. </div>";
            header('location: manage-admin.php');
            exit();
        }
    }
?> 
<?php include('modules/footer.php') ?>