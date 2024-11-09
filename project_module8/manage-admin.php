
<?php 
include('modules/menu.php') 
?>

<!-- Main-Content Section Starts -->
<div class="main-content"> 
    <div class="wrapper"> 
        <h1>Manage Admin</h1><br><br>
    
        
        <?php 
        // Debugging: Check all session variables
        // print_r($_SESSION); 

        if (isset($_SESSION['admin-message'])) {
            echo "<div class='success'>" . $_SESSION['admin-message'] . "</div>"; // Displaying Session Message
            unset($_SESSION['admin-message']); // Clear the message after displaying
        }
        ?>


<!-- Button to add Admin -->

        <a href="add-admin.php" class="btn-primary">Add Admin</a> <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php  
    
            // Query to get all admins from the database
            $sql = "SELECT * FROM admin";
            $result = pg_query($conn, $sql);

            // Check if the query executed successfully
            if ($result==TRUE) {
                // Count rows to check if there is data in the database
                $count = pg_num_rows($result); // Function to get the number of rows in the result set
                $sn = 1; // Create a variable to assign a serial number for the table rows

                // Check if there are any rows
                if ($count > 0) {
                    // Display data in the HTML table
                    while ($rows = pg_fetch_assoc($result)) {
                        // Retrieve individual data from each row
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                    
            ?>

            <!-- Display the values in your HTML table -->
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo htmlspecialchars($full_name); ?></td>
                <td><?php echo htmlspecialchars($username); ?></td>
                <td>
                    <a href="#" class="btn-primary">Change Password</a>
                    <a href="#" class="btn-secondary">Update Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>  
                </td>
            </tr>

            <?php
                    }
                } else {
                    // No data found in the database
                        echo "<tr><td colspan='4' class='error'>No Admins Found.</td></tr>";
                }    
            } else {
                // If the query fails, display an error message
                echo "<tr><td colspan='4' class='error'>Failed to retrieve data from the database.</td></tr>";
            }

                // Close the PostgreSQL connection
                pg_close($conn);
        
            ?>
        </table>
    </div>
</div>
<div class="clearfix">

<!-- Main-Content Section Ends  -->

<?php include('modules/footer.php') ?>