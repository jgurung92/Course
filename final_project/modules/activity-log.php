<?php


function log_activity($conn, $adminUsername, $activityDescription, $action) {

    // // Ensure the description and username are safe to insert
    $ipAddress = $_SERVER['REMOTE_ADDR']=== '::1' ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];


    // SQL query to insert into activity_log table
    $sql = "INSERT INTO activity_log (admin_username, activity_description, action, ip_address, user_agent ) 
            VALUES ($1, $2, $3, $4, $5)";
    $params = array($adminUsername, $activityDescription, $action, $ipAddress, $userAgent);

    // Execute the query with parameters
    $result = pg_query_params($conn, $sql, $params);

    // Check if insertion was successful
    if ($result !== false) {
        return true;
    } else {
        error_log("Error inserting activity log: " . pg_last_error($conn));
        return false;
    }
    // close the connection
    pg_close($conn);
}
?>
