<html>
    <head>
        <title>Chatbot</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="chat-container">
            <h1>Chatbot</h1>
            <div id="chatbot">
                <div id="messages"></div>
            </div>

            <form id="chat-form" method="POST" >
                <input type="text" name="user_input" id="user_input" placeholder="Ask me anything" required>
                <button type="submit">Send</button>
            </form>
        </div>


        <!-- Student Challenge..move this to a js folder and ref in php -->
        <script>
            const form = document.getElementById('chat-form');
            const messages = document.getElementById('messages');

            form.addEventListener("submit", async (e)=> {
                e.preventDefault();
                const userInput = document.getElementById('user_input').value;
                const userMessage =`<div class="user-message"><strong>You:<br><br></strong>${userInput}</div>`;
                messages.innerHTML += userMessage;

                // Fetch data responses in the background
                const response = await fetch('bot_logic.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({user_input: userInput})
                });
                const botResponse = await response.text();
                const botMessage = `<div class="bot-message"><strong>Bot:<br><br></strong>${botResponse}</div>`;
                messages.innerHTML += botMessage;

                form.reset();
            })
        </script>
    </body>
</html>