 <!-- Chatbot Panel -->
    <div id="chatbot" class="chatbot-panel">
        <div class="chat-header">ChatGPT Assistant</div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-input">
            <input type="text" id="chatInput" placeholder="Ask something..." />
            <button id="sendBtn">Send</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-fill p-4">
        <h2 class="mb-4 text-light">@yield('title')</h2>
        @yield('content')
    </div>
</div>

<!-- Toggle Button -->
<button id="chat-toggle-btn"><i class="bi bi-chat-dots"></i></button>

<script>
document.getElementById('chat-toggle-btn').addEventListener('click', () => {
    const panel = document.getElementById('chatbot');
    panel.style.display = (panel.style.display === 'none' || panel.style.display === '') ? 'flex' : 'none';
});
document.getElementById('sendBtn').addEventListener('click', async () => {
    const input = document.getElementById('chatInput');
    const messagesBox = document.getElementById('chatMessages');
    const userMessage = input.value.trim();

    if (!userMessage) return;

    // Show user message
    messagesBox.innerHTML += `<div><strong>You:</strong> ${userMessage}</div>`;
    input.value = '';

    try {
        const res = await fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: userMessage })
        });

        const data = await res.json();
        const botReply = data.reply;

        messagesBox.innerHTML += `<div><strong>ChatGPT:</strong> ${botReply}</div>`;
        messagesBox.scrollTop = messagesBox.scrollHeight;
    } catch (err) {
        messagesBox.innerHTML += `<div><strong>ChatGPT:</strong> ❌ Failed to respond.</div>`;
    }
});
</script>