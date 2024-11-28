<html>
    <head>
        <title>Chatbot</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <!-- Chatbox -->
        <div class="chat-container">
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