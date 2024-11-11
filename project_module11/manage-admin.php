<?php include('modules/menu.php') ?>

<!-- Main-Content Section Starts -->
<div class="main-content"> 
    <div class="wrapper"> 
        <h1>Manage Admin</h1><br>

        <!-- Session Messages -->
        <?php 
            if (isset($_SESSION['admin-message'])) {
                echo "<div class='success'>" . $_SESSION['admin-message'] . "</div>"; 
                unset($_SESSION['admin-message']); 
            }
            if (isset($_SESSION['delete'])) {
                echo "<div class='success'>" . $_SESSION['delete'] . "</div>"; 
                unset($_SESSION['delete']); 
            }
            if (isset($_SESSION['update'])) {
                echo "<div class='success'>" . $_SESSION['update'] . "</div>"; 
                unset($_SESSION['update']); 
            }
            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']); 
            }
            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']); 
            }
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']); 
            }
        ?>

        <!-- Button to add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a> <br><br>

        <!-- Toggle Bar with Sorting and Search -->
        <div class="manage-admin-controls">
            <!-- <button class="btn-primary" onclick="toggleSearch()">Search</button>  -->

            <div  class="search-sort-options">     
                <!-- Sorting Dropdown -->
                <label for="sort-by">Sort By:</label>
                <select id="sort-by" name="sort-by">
                    <option value="id">ID</option>
                    <option value="full_name">Full Name</option>
                    <option value="username">Username</option>
                </select>

                <!-- Search Input Box -->
                <label for="search-query">Search:</label>
                <input type="text" id="search-query" name="search-query" placeholder="Enter ID or Name or Username">
                <button onclick="applySearchSort()">Apply</button> 
            </div>
        </div>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th> 
                <th class="id-column">ID</th>   <!--actual id display here -->
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php  
                // Pagination variables
                $limit = 10; // Number of records per page
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
                $page = max(1, $page); // Ensure at least 1
                $offset = ($page - 1) * $limit; // Calculate offset

                // Get sorting and search values
                $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
                $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                // Query to get paginated admins with sorting and search
                $sql = "SELECT * FROM admin WHERE full_name LIKE '%$search_query%' OR username LIKE '%$search_query%' OR id::text LIKE '%$search_query%' ORDER BY $sort_by LIMIT $limit OFFSET $offset";
                $result = pg_query($conn, $sql);

                if ($result !== false) {
                    $count = pg_num_rows($result); 
                    $sn = $offset + 1; // Starting serial number

                    if ($count > 0) {
                        while ($rows = pg_fetch_assoc($result)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td class="id-column"><?php echo $id; ?></td> <!-- Display Actual ID -->
                            <td><?php echo htmlspecialchars($full_name); ?></td>
                            <td><?php echo htmlspecialchars($username); ?></td>
                            <td>
                                <a href="update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' class='error'>No Admins Found.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='error'>Failed to retrieve data from the database.</td></tr>";
                }
                
                // Query to count total records for pagination
                $total_records_query = "SELECT COUNT(*) AS total FROM admin";
                $total_records_result = pg_query($conn, $total_records_query);

				if ($total_records_result !== false) {
					$total_records_row = pg_fetch_assoc($total_records_result);
					// Check if $total_records_row is valid and contains 'total' 
					$total_records = isset($total_records_row['total']) && is_numeric($total_records_row['total'])
					? (int)$total_records_row['total'] //Cast to an integer for safety
					: 0; //Default to 0 if 'total' is not set or not numeric
				} else {
					// Handle query failure
					$total_records = 0;
				}
				
				// Now $tatal_records is safe to use in calculations
				$total_pages = ceil($total_records / $limit);
			
                // Close the PostgreSQL connection
                pg_close($conn);
            ?>
        </table>

        <!-- Pagination Links -->
        <div class="pagination">
            <?php
                // Previous Link
                if ($page > 1) {
                    echo "<a href='?page=" . ($page - 1) . "&sort_by=$sort_by&search_query=$search_query'>Previous</a> ";
                }
                // Page Number Links
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i === $page) {
                        echo "<strong>$i</strong> "; // Current page in bold
                    } else {
                        echo "<a href='?page=$i&sort_by=$sort_by&search_query=$search_query'>$i</a> ";
                    }
                }
                // Next Link
                if ($page < $total_pages) {
                    echo "<a href='?page=" . ($page + 1) . "&sort_by=$sort_by&search_query=$search_query'>Next</a>";
                }
            ?>
        </div>       
    </div>
</div>
<div class="clearfix"></div> 
<!-- adding toggle.js file here -->
<script src = "toggle.js"></script>  
<!-- Main-Content Section Ends -->
<?php include('modules/footer.php') ?>