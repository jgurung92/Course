<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firewall app login</title>
    <!-- css -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login">
    <h2>Login</h2>
    <form class = "form" action="authentication.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password</label>
        <input type="password" name="password" required><br><br>
        <button class= "button" type = "submit">Login</button>
    </form>
    </div>
</body>
</html>
<?php

?>
