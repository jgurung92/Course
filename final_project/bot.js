
const form = document.getElementById('chat-form');
const messages = document.getElementById('messages');

form.addEventListener("submit", async (e)=> {
    e.preventDefault();
    const userInput = document.getElementById('user_input').value;
    const userMessage =`<div class="user-message"><strong>You:</strong>${userInput}</div>`;
    messages.innerHTML += userMessage;

    // Fetch data responses in the background
    const response = await fetch('modules/bot_logic.php', {
        method: 'POST',
        headers: {
            'Content-type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({user_input: userInput})
    });
    const botResponse = await response.text();
    const botMessage = `<div class="bot-message"><img src='images/icon.png'>${botResponse}</div>`;
    messages.innerHTML += botMessage;
    
    form.reset();
})

// JavaScript to handle chatbot visibility
window.onload = function () {
    // Show chatbot after 10 seconds
    setTimeout(function () {
        document.getElementById('chatbot-container').style.display = 'block';
    }, 10000); // 10 seconds delay

    // Close chatbot when close button is clicked
    document.getElementById('close-chatbot').addEventListener('click', function () {
        document.getElementById('chatbot-container').style.display = 'none'; // Hide chatbot
        document.getElementById('reopen-chatbot').style.display = 'block'; // Show reopen button
    });

    // Reopen chatbot when reopen button is clicked
    document.getElementById('reopen-chatbot').addEventListener('click', function () {
        document.getElementById('chatbot-container').style.display = 'block'; // Show chatbot
        document.getElementById('reopen-chatbot').style.display = 'none'; // Hide reopen button
    });
};
