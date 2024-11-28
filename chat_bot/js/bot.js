const form = document.getElementById('chat-form');
const messages = document.getElementById('messages');

form.addEventListener("submit", async (e)=> {
    e.preventDefault();
    const userInput = document.getElementById('user_input').value;
    const userMessage =`<div class="user-message"><strong>You:</strong>${userInput}</div>`;
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
    const botMessage = `<div class="bot-message"><img src='icon/icon.png'>${botResponse}</div>`;
    messages.innerHTML += botMessage;

    form.reset();
})