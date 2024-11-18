
<?php
// Include database connection and functions
include('conn.php');
include('function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Metrics Form</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Application Metrics </h1>

        <?php
        if (isset($_SESSION['message'])) {
            // Determine if the message is a success or error
            $messageClass = strpos($_SESSION['message'], 'success') !== false ? 'success' : 'error';
            // Display the message with the appropriate class
            echo "<div class='message $messageClass'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);  // Clear the message after displaying
        }
        ?>

        <form action="save_metrics.php" method="POST">
            <label for="page_views">Page Views:</label>
            <input type="number" id="page_views" name="page_views" required>

            <label for="session_duration">Session Duration:</label>
            <input type="text" id="session_duration" name="session_duration" required>

            <label for="bounce_rate">Bounce Rate (%):</label>
            <input type="number" id="bounce_rate" name="bounce_rate" step="0.01" required>

            <label for="traffic_source">Traffic Source:</label>
            <select id="traffic_source" name="traffic_source" required>
                <option value="">Select Traffic Source </option>
                <option value="organic">Organic</option>
                <option value="direct">Direct</option>
                <option value="referral">Referral</option>
                <option value="social">Social</option>
                <option value="email">Email</option>
            </select> 

            <label for="time_on_page">Time on Page:</label>
            <input type="text" id="time_on_page" name="time_on_page" required>

            <label for="previous_visits">Previous Visits:</label>
            <input type="number" id="previous_visits" name="previous_visits" required>

            <label for="conversion_rate">Conversion Rate (%):</label>
            <input type="number" id="conversion_rate" name="conversion_rate" step="0.01" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body> 
</html> 
