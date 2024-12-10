
<?php 
    include('modules/menu.php');
    include('modules/bot_logic.php') 
?>
<?php
    // Fetch activity logs from the database
    $query = "SELECT * FROM activity_log ORDER BY time DESC"; // Modify as needed
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<div class="table-container">
    <h1>Activity Logs</h1><br><br>
    <?php if (!empty($logs)): ?>
        <table class="home-table">
            <thead>
                <tr class="home-row">
                    <th>Log ID</th>
                    <th>Admin Username</th>
                    <th>Activity Description</th>
                    <th>Time</th>
                    <th>Action</th>
                    <th>IP Address</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr class="home-row">
                        <td><?php echo htmlspecialchars($log['log_id']); ?></td>
                        <td><?php echo htmlspecialchars($log['admin_username']); ?></td>
                        <td><?php echo htmlspecialchars($log['activity_description']); ?></td>
                        <td><?php echo htmlspecialchars($log['time']); ?></td>
                        <td><?php echo htmlspecialchars($log['action']); ?></td>
                        <td><?php echo htmlspecialchars($log['ip_address']); ?></td>
                        <td><?php echo htmlspecialchars($log['user_agent']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    
    <?php else: ?>
        <p class="no-data">No activity logs available.</p>
    <?php endif; ?>
</div>
</body>

<!-- CHAT-BOT -->
        <!-- CHAT BOT CONTAINER -->
        <div id="chatbot-container" class="chat-container" style="display: none;">
            <button id="close-chatbot" class="close-button">X</button> <!-- Close button -->
            <h1>I Am Veeru<img src="images/icon.png" alt="Chatbot Icon"></h1>
            <div id="chatbot">
                <div id="messages"></div>
            </div>
            <form id="chat-form" method="POST">
                <input type="text" name="user_input" id="user_input" placeholder="Ask me anything about Steelers" required>
                <button type="submit">Send</button>
            </form>
        </div>

<!-- Reopen button -->
<button id="reopen-chatbot" class="reopen-button" style="display: none;">Chat</button>
<!-- javascript file -->
<script src="bot.js"></script>
<?php include('modules/footer.php') ?>