<html>
    <head>
        <title>Chatbot</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <h2 id="bot-heading">The Bot will display in 10 seconds...</h2>
        <!-- Chatbox -->
        <div id="chatbot-container" class="chat-container" style="display: none;">
            <h1>I Am Veeru<img src='icon/icon.png' ></h1>
            <div id="chatbot">
                <div id="messages"></div>
            </div>

            <form id="chat-form" method="POST" >
                <input type="text" name="user_input" id="user_input" placeholder="Ask me anything about Steelers" required>
                <button type="submit">Send</button>
            </form>
        </div>

        <!-- javascript file -->
        <script src="js/bot.js"></script>
    </body>
</html> 