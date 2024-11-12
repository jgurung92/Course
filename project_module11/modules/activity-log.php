<?php

function log_activity($conn, $admin_id, $admin_username, $activity_description, $action) {
    echo "Logging activity..."; 
    // Capture the current timestamp for the log
    $time = date('Y-m-d H:i:s'); // stores timestamp in the database in the default format

    // Prepare the SQL statement to insert the log into the activity_log table
    $sql = "INSERT INTO activity_log (admin_id, admin_username, activity_description, time, action) 
            VALUES ($1, $2, $3, $4, $5)";

    // Prepare and execute the SQL statement
    $result = pg_query_params($conn, $sql, [$admin_id, $admin_username, $activity_description, $time, $action]);
    if ($result) {
        // Log inserted successfully
        return true;
    } else {
        // Log insertion failed
        echo "Error logging activity: " . pg_last_error($conn);
        return false;
    }
}
?>
