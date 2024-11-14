<?php


function log_activity($conn, $adminId, $adminUsername, $activityDescription, $action) {

    // Ensure the description and username are safe to insert
    $adminUsername = pg_escape_string($adminUsername);
    $activityDescription = pg_escape_string($activityDescription);
    $action = pg_escape_string($action);

    // SQL query to insert into activity_log table
    $sql = "INSERT INTO activity_log (admin_id, admin_username, activity_description, action) 
            VALUES ($1, $2, $3, $4)";
    $params = array($adminId, $adminUsername, $activityDescription, $action);

    // Execute the query with parameters
    $result = pg_query_params($conn, $sql, $params);

    // Check if insertion was successful
    if ($result !== false) {
        return true;
    } else {
        error_log("Error inserting activity log: " . pg_last_error($conn));
        return false;
    }
}
?>
