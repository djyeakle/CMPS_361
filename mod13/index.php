<html>
    <head>
        <title>Apt 612 ChatBot</title>
        <link rel="stylesheet" href="./styles/stylesheet.css">
        <script src="./home.js"></script>
    </head>
    <body>
        <div class="chat-container">
            <h1>Welcome to the Apt 612 ChatBot!</h1>
            <div id="chatbot">
                <div id="messages"></div>
            </div>
            <form id="chat-form" method="POST">
                <input type="text" name="user_input" id="user_input" placeholder="Ask me something!" required>
                <button type="submit">Send</button>
            </form>
        </div>

        <script>
            const form = document.getElementById('chat-form');
            const messages = document.getElementById('messages');

            form.addEventListener("submit", async (e) => {
                e.preventDefault();
                const userInput = document.getElementById('user_input').value;
                const userMessage = `<div class="user-message"><strong>You:</strong> ${userInput}</div>`;
                messages.innerHTML += userMessage;

                //fetch data responses in the background
                const response = await fetch('bot_logic.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ user_input: userInput })
                });

                const botResponse = await response.text();
                const botMessage = `<div class="bot-message"><strong>Bot:</strong> ${botResponse}</div>`;
                messages.innerHTML += botMessage;

                form.reset();
            });
        </script>

    </body>
</html>