<!DOCTYPE html>
<html>
<head>
    <title>Chat with Pusher</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="chat-box">
        <h2>Live Chat</h2>
        <ul id="messages"></ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            if (typeof window.Echo === 'undefined') {
                console.error('Echo is not defined!');
                return;
            }

            window.Echo.channel('chat').listen('.message.sent', (e) => console.log('Got event:', e));

            const ul = document.getElementById('messages');
                    const li = document.createElement('li');
                    li.textContent = 'ok';
                    ul.appendChild(li);

            
            window.Echo.channel('chat')
                .listen('.message.sent', (e) => {
                    const ul = document.getElementById('messages');
                    const li = document.createElement('li');
                    li.textContent = e.message;
                    ul.appendChild(li);
                });
        });
    </script>
</body>
</html>
