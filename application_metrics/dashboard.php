<?php
include('conn.php');
// Query to fetch all records from application_metrics table
$query = "SELECT * FROM application_metrics";
$stmt = $pdo->query($query);

// Fetch data as an associative array
$metrics = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the connection
$pdo = null;

// Prepare data for the chart
$pageViews = array_column($metrics, 'page_views');
$bounceRate = array_column($metrics, 'bounce_rate');
$conversionRate = array_column($metrics, 'conversion_rate');
$createdAt = array_column($metrics, 'created_at');
?>

<!-- <!DOCTYPE html> -->
<html>
<head>
    <title>Dashboard - Application Metrics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
    <script src="js/metricsData.js"></script> <!-- Link to your external JS file -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="metric-container">
        <h1>Application Metric Dashboard</h1>

        <!-- Pie Chart for Page Views -->
        <div class="chart-wrapper">
            <div class="chart-container">
                <h3>Page Views</h3>
                <canvas id="pageViewsChart" class="canvas-size"></canvas>
            </div>

            <!-- Pie Chart for Bounce Rate -->
            <div class="chart-container">
                <h3>Bounce Rate</h3>
                <canvas id="bounceRateChart" class="canvas-size"></canvas>
            </div>

            <!-- Pie Chart for Conversion Rate -->
            <div class="chart-container">
                <h3>Conversion Rate</h3>
                <canvas id="conversionRateChart" class="canvas-size"></canvas>
            </div> <br><br>
        </div>

        <?php if ($metrics && count($metrics) > 0): ?>
            <table class="table_display">
                <thead>
                    <tr>
                        <th>Page Views</th>
                        <th>Session Duration</th>
                        <th>Bounce Rate</th>
                        <th>Traffic Source</th>
                        <th>Time on Page</th>
                        <th>Previous Visits</th>
                        <th>Conversion Rate</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($metrics as $metric): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($metric['page_views']); ?></td>
                            <td><?php echo htmlspecialchars($metric['session_duration']); ?></td>
                            <td><?php echo htmlspecialchars($metric['bounce_rate']); ?>%</td>
                            <td><?php echo htmlspecialchars($metric['traffic_source']); ?></td>
                            <td><?php echo htmlspecialchars($metric['time_on_page']); ?></td>
                            <td><?php echo htmlspecialchars($metric['previous_visits']); ?></td>
                            <td><?php echo htmlspecialchars($metric['conversion_rate']); ?>%</td>
                            <td><?php echo htmlspecialchars($metric['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No data available in the database.</p>
        <?php endif; ?>
    </div>

    <!-- Embedding PHP data in hidden elements -->
    <div style="display:none;">
        <span id="pageViewsData"><?php echo json_encode($pageViews); ?></span>
        <span id="bounceRateData"><?php echo json_encode($bounceRate); ?></span>
        <span id="conversionRateData"><?php echo json_encode($conversionRate); ?></span>
        <span id="createdAtData"><?php echo json_encode($createdAt); ?></span>
    </div> 

</body>
</html>
