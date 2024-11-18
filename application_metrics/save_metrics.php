<?php
include('conn.php');
include('function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $data = [
        'page_views'       => $_POST['page_views'] ?? null,
        'session_duration' => $_POST['session_duration'] ?? null,
        'bounce_rate'      => $_POST['bounce_rate'] ?? null,
        'traffic_source'   => $_POST['traffic_source'] ?? null,
        'time_on_page'     => $_POST['time_on_page'] ?? null,
        'previous_visits'  => $_POST['previous_visits'] ?? null,
        'conversion_rate'  => $_POST['conversion_rate'] ?? null,
    ];

    // Validate inputs
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $_SESSION['message'] = "Error: $key is required.";
            header("Location: metrics.php");
            exit();
        }
    }
    // Save metrics to database
    $result = saveMetrics($pdo, $data);

    // Check result
    if ($result === true) {
        $_SESSION['message'] = "Metrics saved successfully!";  // Session Message for Success
    } else {
        $_SESSION['message'] = "Error saving metrics: $result"; // Session Message for Error
    }
    header('Location: metrics.php');  // Redirect back to metrics page   
    exit();
}
?>
