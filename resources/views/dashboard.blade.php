<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column justify-content-between py-4 px-2">
        <div>
            <a href="/" class="text-decoration-none text-white fw-bold fs-4 mb-4 d-block text-center">ADMIN_CNTR</a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="bi-house"></i> DASHBOARD
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/articles" class="nav-link">
                        <i class="bi-table"></i> ARTICLES
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/articles/create" class="nav-link">
                        <i class="bi-plus-circle"></i> ADD_ARTICLE
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/media" class="nav-link">
                        <i class="bi-image"></i> MEDIA
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users" class="nav-link">
                        <i class="bi-people"></i> USERS
                    </a>
                </li>
            </ul>
        </div>

        <!-- Profile Dropdown -->
        <div class="dropdown text-center">
            <a href="#" class="d-flex align-items-center justify-content-center link-light text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown">
                <i class="bi-person-circle fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                @auth
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">PROFILE</a></li>
                @endauth
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">LOGOUT</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

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

</body>
</html>
