<?php include('modules/config.php') ?>

<html>
    <head>
        <title>Login - Nepal Restaurant System</title>
        <link rel="stylesheet" href="admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login </h1><br><br>

            <?php 
            // Debugging: Check all session variables
            // print_r($_SESSION); 
                //  Message Session for login
                if (isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']); // Clear the message after displaying
                }

                // //  Message Session for login failed
                // if (isset($_SESSION['no-login-message'])) {
                //     echo $_SESSION['no-login-message'];
                //     unset($_SESSION['no-login-message']); 
                // }
            ?>
            <br><br>

            <!-- Login Form Starts here -->
            <form action="" method="POST" class="text-center">
                Username: <br><br>
                <input type="text" name="username" placeholder="Enter Username" class="input"><br><br>
                Password: <br><br>
                <input type="password" name="password" placeholder="Enter Password" class="input"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary input" ><br><br>
            </form>
            <!-- Login Form Ends here -->
            <p class="text-center">Created By - <a href="#">Jiten Gurung</a></p>
        </div>
    </body>
</html>

<?php 
    // Check whether the Submit Button is clicked or not
    if(isset($_POST['submit'])) {
        // Process for Login
        //1. Get the Data from Login form 
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password']));

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM admin WHERE username = $1 AND password = $2";

        //3. Execute the Query
        $result = pg_query_params($conn, $sql, array($username, $password)); // Use pg_query_params to prevent SQL injection

        //4. Count rows to check if user exists
    if ($result && pg_num_rows($result) === 1) {
        // User exists, login success
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username; // Store username to check login status

        //5. Redirect to manage-admin.php
        header("Location: manage-admin.php");
        exit();
    } else {
        //6. Login failed, user doesn't exist
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
        header("Location: login.php"); // Redirect back to login page with error message
        exit();
    }

    // Close the database connection
    pg_close($conn);
    }
?>