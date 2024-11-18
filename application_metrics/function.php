<?php
function saveMetrics($pdo, $data) {
    try {
        // Prepare SQL query
        $sql = "
            INSERT INTO application_metrics (page_views, session_duration, bounce_rate, traffic_source, time_on_page, previous_visits, conversion_rate, created_at)
            VALUES (:page_views, :session_duration, :bounce_rate, :traffic_source, :time_on_page, :previous_visits, :conversion_rate, NOW())
        ";

        // Prepare statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute
        $stmt->execute([
            ':page_views'      => $data['page_views'],
            ':session_duration'=> $data['session_duration'],
            ':bounce_rate'     => $data['bounce_rate'],
            ':traffic_source'  => $data['traffic_source'],
            ':time_on_page'    => $data['time_on_page'],
            ':previous_visits' => $data['previous_visits'],
            ':conversion_rate' => $data['conversion_rate'],
        ]);

        return true; // Indicate success
    } catch (PDOException $e) {
        return "Error saving metrics: " . $e->getMessage();
    }
}
?>
