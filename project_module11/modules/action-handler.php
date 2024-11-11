<?php
include('config.php'); // Include config if needed

// Get action and ID from the form
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($action && $id) {
    // Determine the destination page based on the selected action
    switch ($action) {
        case 'update-password':
            header("Location: change-password.php?id=$id");
            break;
        case 'update-admin':
            header("Location: update-admin.php?id=$id");
            break;
        case 'delete-admin':
            header("Location: delete-admin.php?id=$id");
            break;
        default:
            echo "Invalid action.";
            exit();
    }
    exit(); // Make sure to stop execution after redirection
} else {
    echo "Invalid request.";
}
?>
