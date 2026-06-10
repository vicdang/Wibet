<?php
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 */

$this->title = 'Support Center';
$currentUser = Yii::$app->user->identity;
?>

<style>
/* Modern Comments & AI Chat Page */
.site-comments {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .site-comments {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
    --accent: #0084ff;
}

.comments-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Hero Section */
.comments-hero {
    text-align: center;
    margin-bottom: 50px;
    padding-bottom: 40px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.comments-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 16px 0;
    letter-spacing: -1px;
    line-height: 1.1;
}

[data-theme="light"] .comments-hero h1 {
    color: #1a1a1a;
}

.comments-hero p {
    font-size: 1.1rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0;
    line-height: 1.6;
}

/* Main Content Layout */
.comments-content {
    display: flex;
    flex-direction: row;
    align-items: stretch;
    gap: 24px;
    max-width: 1200px;
    margin: 0 auto;
}

/* Support Columns */
.ai-chat-column,
.quick-help-column,
.right-column {
    flex: 1;
    min-width: 280px;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.ai-chat-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}

[data-theme="light"] .ai-chat-card {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.ai-chat-header {
    padding: 20px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    display: flex;
    align-items: center;
    justify-content: space-between;
}

[data-theme="light"] .ai-chat-header {
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

.ai-chat-header-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 700;
    font-size: 1.1rem;
}

.ai-chat-badge {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(0, 212, 255, 0.2);
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #00d4ff;
}

[data-theme="light"] .ai-chat-badge {
    background: rgba(31, 115, 230, 0.15);
    color: #1f73e6;
}

.ai-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    min-height: 300px;
    max-height: 500px;
}

.ai-chat-message {
    padding: 12px 14px;
    border-radius: 8px;
    font-size: 0.95rem;
    line-height: 1.5;
    max-width: 90%;
    word-wrap: break-word;
}

.ai-chat-message.user {
    background: rgba(0, 212, 255, 0.15);
    color: #e8eaf0;
    align-self: flex-end;
}

[data-theme="light"] .ai-chat-message.user {
    background: rgba(31, 115, 230, 0.15);
    color: #1a1a1a;
}

.ai-chat-message.bot {
    background: rgba(255, 255, 255, 0.08);
    color: #e8eaf0;
    align-self: flex-start;
}

[data-theme="light"] .ai-chat-message.bot {
    background: rgba(0, 0, 0, 0.05);
    color: #1a1a1a;
}

.ai-chat-message.welcome {
    align-self: flex-start;
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.8);
}

[data-theme="light"] .ai-chat-message.welcome {
    color: rgba(0, 0, 0, 0.65);
}

.ai-chat-message.error {
    background: rgba(244, 67, 54, 0.15);
    color: #ff9a9a;
}

[data-theme="light"] .ai-chat-message.error {
    background: rgba(217, 48, 37, 0.1);
    color: #d93025;
}

.ai-chat-message.loading {
    color: rgba(232, 234, 240, 0.6);
    font-style: italic;
}

[data-theme="light"] .ai-chat-message.loading {
    color: rgba(0, 0, 0, 0.5);
}

.ai-chat-footer {
    padding: 16px;
    border-top: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    display: flex;
    gap: 8px;
}

[data-theme="light"] .ai-chat-footer {
    border-top-color: rgba(0, 0, 0, 0.1);
}

.ai-chat-input {
    flex: 1;
    padding: 10px 14px;
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 6px;
    background: rgba(0, 0, 0, 0.3);
    color: #e8eaf0;
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.2s ease;
}

.ai-chat-input:focus {
    outline: none;
    border-color: rgba(0, 212, 255, 0.4);
    background: rgba(0, 0, 0, 0.4);
}

.ai-chat-input::placeholder {
    color: rgba(232, 234, 240, 0.5);
}

[data-theme="light"] .ai-chat-input {
    background: #f5f5f5;
    border-color: rgba(0, 0, 0, 0.1);
    color: #1a1a1a;
}

[data-theme="light"] .ai-chat-input:focus {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.2);
}

[data-theme="light"] .ai-chat-input::placeholder {
    color: rgba(0, 0, 0, 0.4);
}

.ai-chat-send {
    width: 40px;
    height: 40px;
    padding: 0;
    background: linear-gradient(135deg, #00d4ff, #7b2fff);
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: 18px;
    transition: all 0.2s ease;
}

.ai-chat-send:hover {
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.3);
    transform: translateY(-1px);
}

.ai-chat-send:active {
    transform: translateY(0);
}

/* Right Column - Group Card */
.right-column {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Join Group Card */
.join-group-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    transition: all 0.3s ease;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.join-group-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .join-group-card {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .join-group-card:hover {
    border-color: rgba(31, 115, 230, 0.3);
    box-shadow: 0 8px 24px rgba(31, 115, 230, 0.1);
}

.group-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 16px;
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.join-group-card:hover .group-icon {
    transform: scale(1.05);
}

.group-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 0 12px 0;
    color: #00d4ff;
}

[data-theme="light"] .group-title {
    color: #1f73e6;
}

.group-description {
    font-size: 0.9rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0 0 20px 0;
    line-height: 1.6;
}

[data-theme="light"] .group-description {
    color: rgba(0, 0, 0, 0.65);
}

.join-btn {
    display: inline-block;
    padding: 10px 24px;
    background: linear-gradient(135deg, #00d4ff, #7b2fff);
    color: #ffffff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.25);
    border: none;
    cursor: pointer;
}

.join-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0, 212, 255, 0.35);
    text-decoration: none;
}

[data-theme="light"] .join-btn {
    background: linear-gradient(135deg, #1f73e6, #4285f4);
    box-shadow: 0 4px 12px rgba(31, 115, 230, 0.2);
}

[data-theme="light"] .join-btn:hover {
    box-shadow: 0 6px 16px rgba(31, 115, 230, 0.3);
}

/* Quick Help Column */
.quick-help-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 16px;
    padding: 24px;
    width: 100%;
    height: 100%;
}

[data-theme="light"] .quick-help-card {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.quick-help-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 0 20px 0;
    color: #00d4ff;
}

[data-theme="light"] .quick-help-title {
    color: #1f73e6;
}

.help-item {
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
    transition: all 0.2s ease;
}

.help-item:last-child {
    border-bottom: none;
}

.help-item a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--text-primary, #e8eaf0);
    text-decoration: none;
    font-size: 0.95rem;
    padding: 8px 0;
    transition: all 0.2s ease;
}

.help-item a:hover {
    padding-left: 8px;
    color: #00d4ff;
}

[data-theme="light"] .help-item a:hover {
    color: #1f73e6;
}

.help-icon {
    font-size: 1.2rem;
    min-width: 24px;
    text-align: center;
}


/* Mobile Responsive */
@media (max-width: 1024px) {
    .comments-content {
        gap: 36px;
    }
}

@media (max-width: 768px) {
    .site-comments {
        padding: 24px 16px;
    }

    .comments-container {
        max-width: 100%;
    }

    .comments-hero {
        margin-bottom: 36px;
        padding-bottom: 28px;
    }

    .comments-hero h1 {
        font-size: 2rem;
    }

    .comments-hero p {
        font-size: 0.95rem;
    }

    .comments-content {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .ai-chat-card {
        max-height: none;
    }

    .ai-chat-messages {
        min-height: 250px;
        max-height: 400px;
    }

    .join-group-card {
        padding: 32px 24px;
        margin-bottom: 24px;
    }

    .group-icon {
        width: 90px;
        height: 90px;
        margin-bottom: 16px;
    }

    .group-title {
        font-size: 1.3rem;
    }

    .group-description {
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .join-btn {
        padding: 11px 28px;
        font-size: 0.9rem;
    }

}

@media (max-width: 480px) {
    .site-comments {
        padding: 16px 12px;
    }

    .comments-hero {
        margin-bottom: 28px;
        padding-bottom: 24px;
    }

    .comments-hero h1 {
        font-size: 1.5rem;
        margin-bottom: 12px;
    }

    .comments-hero p {
        font-size: 0.9rem;
    }

    .ai-chat-card {
        border-radius: 12px;
    }

    .ai-chat-header {
        padding: 16px;
    }

    .ai-chat-header-title {
        gap: 8px;
        font-size: 1rem;
    }

    .ai-chat-messages {
        padding: 16px;
        min-height: 200px;
        max-height: 300px;
    }

    .ai-chat-footer {
        padding: 12px;
        gap: 6px;
    }

    .ai-chat-input {
        padding: 8px 10px;
        font-size: 0.9rem;
    }

    .ai-chat-send {
        width: 36px;
        height: 36px;
        font-size: 16px;
    }

    .join-group-card {
        padding: 24px 20px;
        margin-bottom: 20px;
    }

    .group-icon {
        width: 80px;
        height: 80px;
        margin-bottom: 14px;
    }

    .group-title {
        font-size: 1.15rem;
    }

    .group-description {
        font-size: 0.85rem;
        margin-bottom: 16px;
    }

    .join-btn {
        padding: 10px 24px;
        font-size: 0.85rem;
    }

}
</style>

<div class="site-comments">
    <div class="comments-container">
        <!-- Hero Section -->
        <div class="comments-hero">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Get instant help from our AI Assistant or connect with the community</p>
        </div>

        <!-- Three-Column Layout -->
        <div class="comments-content" style="flex-direction: row; max-width: 1200px; gap: 24px; display: flex; justify-content: center; flex-wrap: wrap;">
            <!-- AI Chat Column (Left) -->
            <div class="ai-chat-column">
                <div class="ai-chat-card">
                    <div class="ai-chat-header">
                        <div class="ai-chat-header-title">
                            <img src="/logo.png" alt="<?= Html::encode(Yii::$app->params['appName']) ?>" style="width: 24px; height: 24px; border-radius: 4px;">
                            <span><?= Html::encode(Yii::$app->params['appName']) ?> Agent</span>
                        </div>
                        <span class="ai-chat-badge" id="providerBadge">Claude</span>
                    </div>
                    <div class="ai-chat-messages" id="aiChatMessages">
                        <div class="ai-chat-message welcome">
                            Hello! I can help you with betting rules, match information, team statistics, and tournament details. Ask me anything about World Cup 2026!
                        </div>
                    </div>
                    <div class="ai-chat-footer">
                        <input type="text" class="ai-chat-input" id="aiChatInput" placeholder="Ask about rules, teams, matches...">
                        <button class="ai-chat-send" id="aiChatSend" title="Send message">⬆</button>
                    </div>
                </div>
            </div>

            <!-- Quick Help Column (Middle) -->
            <div class="quick-help-column">
                <div class="quick-help-card">
                    <h3 class="quick-help-title">📚 Quick Help</h3>
                    <div class="help-item">
                        <a href="<?= Url::to(['/site/rules']) ?>">
                            <span class="help-icon">📖</span>
                            <span>Game Rules & Regulations</span>
                        </a>
                    </div>
                    <div class="help-item">
                        <a href="<?= Url::to(['/team/index']) ?>">
                            <span class="help-icon">⚽</span>
                            <span>Teams & Tournaments</span>
                        </a>
                    </div>
                    <div class="help-item">
                        <a href="<?= Url::to(['/match/index']) ?>">
                            <span class="help-icon">🎯</span>
                            <span>Upcoming Matches</span>
                        </a>
                    </div>
                    <div class="help-item">
                        <a href="<?= Url::to(['/ranking/index']) ?>">
                            <span class="help-icon">🏆</span>
                            <span>Player Rankings</span>
                        </a>
                    </div>
                    <div class="help-item">
                        <a href="<?= Url::to(['/user/account']) ?>">
                            <span class="help-icon">👤</span>
                            <span>My Account Settings</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Community -->
            <div class="right-column">
                <!-- Join Group Card -->
                <a href="<?= Yii::$app->params['groupChat'] ?>" target="_blank" class="join-group-link" style="text-decoration: none;">
                    <div class="join-group-card">
                        <img src="/images/cup.png" alt="Join Group" class="group-icon">
                        <h2 class="group-title">Join Our Group Chat</h2>
                        <p class="group-description">
                            Connect with other fans, discuss matches, share predictions, and celebrate victories together
                        </p>
                        <button class="join-btn">
                            Join Now →
                        </button>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const messagesDiv = document.getElementById('aiChatMessages');
    const input = document.getElementById('aiChatInput');
    const sendBtn = document.getElementById('aiChatSend');
    const providerBadge = document.getElementById('providerBadge');

    let apiKey = '';

    // Load API key on page load
    fetch('/config/get-ai-config')
        .then(r => r.json())
        .then(data => {
            apiKey = data.api_key || '';
            providerBadge.textContent = 'HuggingFace';
            if (!apiKey) {
                const errorMsg = document.createElement('div');
                errorMsg.className = 'ai-chat-message error';
                errorMsg.textContent = '⚠️ HuggingFace API key not configured. Please go to /config/index and add your API key.';
                messagesDiv.appendChild(errorMsg);
            }
        })
        .catch(e => {
            console.error('Failed to load API config:', e);
            providerBadge.textContent = 'HuggingFace';
        });

    function sendMessage() {
        const message = input.value.trim();
        if (!message) return;

        if (!apiKey) {
            const errorMsg = document.createElement('div');
            errorMsg.className = 'ai-chat-message error';
            errorMsg.textContent = '⚠️ API key not configured. Please set it in /config/index.';
            messagesDiv.appendChild(errorMsg);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
            return;
        }

        // Add user message
        const userMsg = document.createElement('div');
        userMsg.className = 'ai-chat-message user';
        userMsg.textContent = message;
        messagesDiv.appendChild(userMsg);

        input.value = '';
        messagesDiv.scrollTop = messagesDiv.scrollHeight;

        // Add loading indicator
        const loadingMsg = document.createElement('div');
        loadingMsg.className = 'ai-chat-message loading';
        loadingMsg.textContent = 'Thinking...';
        messagesDiv.appendChild(loadingMsg);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;

        // Call HuggingFace API directly from browser
        const prompt = 'You are a helpful AI assistant for World Cup 2026 betting application called Wibet. ' +
            'Answer questions about betting rules, teams, matches, and tournament format. Be concise and friendly. ' +
            'User question: ' + message;

        const payload = {
            inputs: prompt,
            parameters: {max_length: 512, temperature: 0.7}
        };

        fetch('https://api-inference.huggingface.co/models/google/flan-t5-base', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + apiKey,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(r => r.json())
        .then(data => {
            loadingMsg.remove();
            if (data && data[0] && data[0].generated_text) {
                let reply = data[0].generated_text;
                reply = reply.replace(prompt, '').trim();
                if (!reply) reply = 'I apologize, but I could not generate a response. Please try again.';
                const botMsg = document.createElement('div');
                botMsg.className = 'ai-chat-message bot';
                botMsg.textContent = reply;
                messagesDiv.appendChild(botMsg);
            } else {
                const errorMsg = document.createElement('div');
                errorMsg.className = 'ai-chat-message error';
                errorMsg.textContent = 'Error: Unexpected API response. Please try again.';
                messagesDiv.appendChild(errorMsg);
            }
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        })
        .catch(error => {
            loadingMsg.remove();
            const errorMsg = document.createElement('div');
            errorMsg.className = 'ai-chat-message error';
            errorMsg.textContent = 'Error: ' + (error.message || 'Unable to reach AI service. Check your API key.');
            messagesDiv.appendChild(errorMsg);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });
})();
</script>
