<?php include('modules/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br>
        <?php
            if (isset($_SESSION['admin-message'])) {
                echo "<div class='error'>" . $_SESSION['admin-message'] . "</div>"; // Displaying Session Message
                unset($_SESSION['admin-message']); // Clear the message after displaying
            }
        ?> <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('modules/footer.php'); ?>

<?php 
if(isset($_POST['submit'])) {
    // Get the data from Form
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);  // Encrypt password with md5

    // Check if the field is empty
    if (empty($full_name) || empty($username) || empty($password)) {
        // Redirect with error message if any field is empty
        $_SESSION['admin-message'] = "Failed to add admin: All fields are required"; 
        header("Location: add-admin.php");
        exit();
    }

    // Encrypt password with md5
    $password = md5($password);

    // SQL query to insert data into the 'admin' table
    $sql = "INSERT INTO admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    // Execute the query
    $result = pg_query($conn, $sql);

    // Check if the query was successful
    if ($result==true) {
        $_SESSION['admin-message'] = "Admin added successfully!"; // Store message in session
        header("Location: manage-admin.php");
    } else {
        $_SESSION['admin-message'] = "Failed to add admin"; 
        header("Location: add-admin.php");
    }
// Close the connection
pg_close($conn);
}
?>