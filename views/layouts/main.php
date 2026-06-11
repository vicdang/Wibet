<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\Helper;
use app\models\AdminConfig;
use amnah\yii2\user\models\User;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
$controller = Yii::$app->controller;
$action = $controller->action->id;
$controller = $controller->id;

// Load theme and merge admin config overrides
$theme = AdminConfig::getTheme();
$overrideMap = [
    'season_name' => 'seasonName',
    'group_chat' => 'groupChat',
    'admin_chat' => 'adminChat',
    'admin_name' => 'adminName',
    'admin_email' => 'adminEmail'
];
foreach ($overrideMap as $dbKey => $paramKey) {
    $val = AdminConfig::get($dbKey);
    if ($val !== null && $val !== '') {
        Yii::$app->params[$paramKey] = $val;
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;700;800&display=swap">
    <?php $this->registerCssFile('/css/theme-dark.css?v=23'); ?>
    <?php $this->registerCssFile('/css/theme-light.css?v=23'); ?>
    <?php $this->head() ?>
</head>
<body class="<?php echo $controller .' '. $action ?>" data-theme="<?= $theme ?>">

<?php $this->beginBody() ?>
    <div class="wrap" <?php if ($controller === 'site' && $action === 'index'): ?>style="background: none !important;"<?php endif; ?>>
        <?php
            NavBar::begin([
                'brandLabel' => '<span id="brand-logo"></span>' . Yii::$app->params['appName'],
                // 'brandUrl' => Yii::$app->homeUrl,
                'brandUrl' => "/",
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'activateParents' => true,
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Stats', 'url' => ['/site/analysis'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'analysis'],
                    ['label' => 'Rules', 'url' => ['/site/rules'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'rules'],
                    ['label' => 'Ranking', 'url' => ['/ranking/index'], 'active' => Yii::$app->controller->id === 'ranking' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Tour', 'url' => ['/team/index'], 'active' => Yii::$app->controller->id === 'team' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Matches', 'url' => ['/match/index'], 'visible' => !Yii::$app->user->isGuest, 'active' => Yii::$app->controller->id === 'match' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Support', 'url' => ['/site/comment'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'comment'],
                    ['label' => 'Users', 'url' => ['/user/admin/index'], 'visible' => Yii::$app->user->can('admin'), 'active' => Yii::$app->controller->id === 'admin' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Teams', 'url' => ['/team/admin-index'], 'visible' => Yii::$app->user->can('admin'), 'active' => Yii::$app->controller->id === 'team' && Yii::$app->controller->action->id === 'admin-index'],
                    ['label' => 'Config', 'url' => ['/config/index'], 'visible' => Yii::$app->user->can('admin'), 'active' => Yii::$app->controller->id === 'config' && Yii::$app->controller->action->id === 'index'],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/login']] :
                        ['label' => Yii::$app->user->displayName . ' <span class="badge badge-pill badge-warning u-point">' . Helper::formatMoney(Yii::$app->user->money) .'</span>', 'url'=>["/"] ,
                            'items' => [
                                [
                                    'label' => 'Account',
                                    'url' => ['/user/account'],
                                ],
                                [
                                    'label' => 'Profile',
                                    'url' => ['/user/profile'],
                                ],
                                [
                                    'label' => 'Logout',
                                    'url' => ['/user/logout'],
                                    'linkOptions' => ['data-method' => 'post']],
                                ],
                            ],

                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['appName'] ?> <?= date('Y') ?> by <a href="#" target="_blank"><?= Yii::$app->params['team'] ?></a></p>
            <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
        </div>
    </footer>

    <!-- Floating AI Chat Widget -->
    <?php if (!Yii::$app->user->isGuest): ?>
    <style>
        .ai-chat-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .ai-chat-btn:hover {
            transform: scale(1.15);
        }

        .ai-chat-panel {
            position: fixed;
            bottom: 100px;
            right: 24px;
            width: 480px;
            height: 75vh;
            max-height: 800px;
            background: rgba(10, 14, 26, 0.95);
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 212, 255, 0.15);
            display: none;
            flex-direction: column;
            z-index: 999;
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        @media (max-width: 480px) {
            .ai-chat-panel {
                width: calc(100vw - 16px);
                right: 8px;
                height: 80vh;
            }
        }

        @media (min-width: 481px) and (max-width: 900px) {
            .ai-chat-panel {
                width: 420px;
                height: 75vh;
            }
        }

        [data-theme="light"] .ai-chat-panel {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .ai-chat-panel.open {
            display: flex;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ai-chat-header {
            padding: 16px;
            border-bottom: 1px solid rgba(0, 212, 255, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        [data-theme="light"] .ai-chat-header {
            border-bottom-color: rgba(0, 0, 0, 0.1);
        }

        .ai-chat-title {
            font-weight: 700;
            color: #e8eaf0;
            font-size: 14px;
        }

        [data-theme="light"] .ai-chat-title {
            color: #1a1a1a;
        }

        .ai-chat-close {
            background: none;
            border: none;
            color: #00d4ff;
            cursor: pointer;
            font-size: 18px;
        }

        .ai-chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .ai-chat-message {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            line-height: 1.6;
            word-break: break-word;
        }

        .ai-chat-message.user {
            background: rgba(0, 212, 255, 0.15);
            color: #e8eaf0;
            align-self: flex-end;
            max-width: 85%;
        }

        [data-theme="light"] .ai-chat-message.user {
            background: rgba(0, 132, 255, 0.15);
            color: #1a1a1a;
        }

        .ai-chat-message.bot {
            background: rgba(255, 255, 255, 0.07);
            color: #e8eaf0;
            align-self: flex-start;
            max-width: 92%;
        }

        [data-theme="light"] .ai-chat-message.bot {
            background: rgba(0, 0, 0, 0.05);
            color: #1a1a1a;
        }

        .ai-chat-message.bot p   { margin: 0 0 6px; }
        .ai-chat-message.bot p:last-child { margin-bottom: 0; }
        .ai-chat-message.bot ul,
        .ai-chat-message.bot ol  { margin: 4px 0 6px; padding-left: 22px; }
        .ai-chat-message.bot li  { margin-bottom: 3px; }
        .ai-chat-message.bot strong { color: #00d4ff; font-weight: 600; }
        [data-theme="light"] .ai-chat-message.bot strong { color: #0077cc; }
        .ai-chat-message.bot code {
            background: rgba(0,212,255,0.1);
            border-radius: 4px;
            padding: 1px 5px;
            font-family: monospace;
            font-size: 12px;
        }

        .ai-chat-message.error {
            background: rgba(244, 67, 54, 0.15);
            color: #ff9a9a;
        }

        [data-theme="light"] .ai-chat-message.error {
            background: rgba(217, 48, 37, 0.1);
            color: #d93025;
        }

        .ai-chat-footer {
            padding: 12px;
            border-top: 1px solid rgba(0, 212, 255, 0.15);
            display: flex;
            gap: 8px;
        }

        [data-theme="light"] .ai-chat-footer {
            border-top-color: rgba(0, 0, 0, 0.1);
        }

        .ai-chat-input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid rgba(0, 212, 255, 0.2);
            border-radius: 6px;
            background: rgba(0, 0, 0, 0.3);
            color: #e8eaf0;
            font-size: 13px;
            font-family: inherit;
        }

        [data-theme="light"] .ai-chat-input {
            background: #f5f5f5;
            border-color: rgba(0, 0, 0, 0.1);
            color: #1a1a1a;
        }

        .ai-chat-input::placeholder {
            color: rgba(232, 234, 240, 0.5);
        }

        [data-theme="light"] .ai-chat-input::placeholder {
            color: rgba(0, 0, 0, 0.4);
        }

        .ai-chat-send {
            width: 36px;
            height: 36px;
            padding: 0;
            background: linear-gradient(135deg, #00d4ff, #7b2fff);
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        .ai-chat-send:hover {
            box-shadow: 0 4px 12px rgba(0, 212, 255, 0.3);
        }

        .ai-chat-loading {
            text-align: center;
            color: rgba(232, 234, 240, 0.6);
            font-size: 12px;
            padding: 8px;
        }

        [data-theme="light"] .ai-chat-loading {
            color: rgba(0, 0, 0, 0.5);
        }
    </style>

    <button class="ai-chat-btn" id="aiChatBtn" title="Quick Help">
        <img src="/logo.png" style="width: 64px; height: 64px;">
    </button>

    <div class="ai-chat-panel" id="floatingChatPanel">
        <div class="ai-chat-header">
            <span class="ai-chat-title"><?= Html::encode(Yii::$app->params['appName']) ?> Agent</span>
            <button class="ai-chat-close" id="floatingChatClose">×</button>
        </div>
        <div class="ai-chat-messages" id="floatingChatMessages"></div>
        <div class="ai-chat-footer">
            <input type="text" class="ai-chat-input" id="floatingChatInput" placeholder="Ask about rules, teams, matches...">
            <button class="ai-chat-send" id="floatingChatSend" title="Send">⬆</button>
        </div>
    </div>

    <script>
    (function() {
        const chatBtn   = document.getElementById('aiChatBtn');
        const chatPanel = document.getElementById('floatingChatPanel');
        const closeBtn  = document.getElementById('floatingChatClose');
        const messages  = document.getElementById('floatingChatMessages');
        const input     = document.getElementById('floatingChatInput');
        const sendBtn   = document.getElementById('floatingChatSend');
        const STORAGE_KEY = 'floatingChatHistory';
        const WELCOME = 'Hello! I can help you with rules, match information, team statistics, and tournament details. Ask me anything!';

        function renderMarkdown(text) {
            const esc = s => s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            const inline = s => esc(s)
                .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                .replace(/`([^`]+)`/g, '<code>$1</code>');

            let html = '';
            let listType = null;
            let paragraph = [];

            const flushParagraph = () => {
                if (paragraph.length) {
                    html += '<p>' + paragraph.join('<br>') + '</p>';
                    paragraph = [];
                }
            };
            const closeList = () => {
                if (listType) {
                    html += '</' + listType + '>';
                    listType = null;
                }
            };

            text.split('\n').forEach(line => {
                const trimmed = line.trim();
                const bulletMatch = trimmed.match(/^[*\-]\s+(.+)/);
                const numberMatch = trimmed.match(/^\d+\.\s+(.+)/);

                if (bulletMatch) {
                    flushParagraph();
                    if (listType !== 'ul') { closeList(); html += '<ul>'; listType = 'ul'; }
                    html += '<li>' + inline(bulletMatch[1]) + '</li>';
                } else if (numberMatch) {
                    flushParagraph();
                    if (listType !== 'ol') { closeList(); html += '<ol>'; listType = 'ol'; }
                    html += '<li>' + inline(numberMatch[1]) + '</li>';
                } else if (trimmed === '') {
                    closeList();
                    flushParagraph();
                } else {
                    closeList();
                    paragraph.push(inline(line));
                }
            });
            closeList();
            flushParagraph();
            return html;
        }

        function addMsg(text, cls) {
            const div = document.createElement('div');
            div.className = 'ai-chat-message ' + cls;
            if (cls === 'bot') {
                div.innerHTML = renderMarkdown(text);
            } else {
                div.textContent = text;
            }
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
            return div;
        }

        function saveHistory() {
            const items = messages.querySelectorAll('.ai-chat-message:not(.loading-indicator)');
            const data = Array.from(items).map(el => ({ cls: el.className.replace('ai-chat-message ', ''), text: el.textContent }));
            try { sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data)); } catch(e) {}
        }

        function loadHistory() {
            try {
                const stored = sessionStorage.getItem(STORAGE_KEY);
                if (stored) {
                    JSON.parse(stored).forEach(item => addMsg(item.text, item.cls));
                    return true;
                }
            } catch(e) {}
            return false;
        }

        if (!loadHistory()) addMsg(WELCOME, 'bot');

        // Restore open state across page navigations
        if (sessionStorage.getItem('floatingChatOpen') === '1') {
            chatPanel.classList.add('open');
            messages.scrollTop = messages.scrollHeight;
        }

        chatBtn.addEventListener('click', function() {
            chatPanel.classList.toggle('open');
            const isOpen = chatPanel.classList.contains('open');
            if (isOpen) { messages.scrollTop = messages.scrollHeight; input.focus(); }
        });
        closeBtn.addEventListener('click', function() { chatPanel.classList.remove('open'); });
        document.addEventListener('click', function(e) {
            // Don't close when clicking a link — navigation will preserve state via beforeunload
            if (e.target.closest('a')) return;
            if (!chatPanel.contains(e.target) && !chatBtn.contains(e.target)) chatPanel.classList.remove('open');
        });

        // Save open state right before navigating away so the next page can restore it
        window.addEventListener('beforeunload', function() {
            sessionStorage.setItem('floatingChatOpen', chatPanel.classList.contains('open') ? '1' : '0');
        });

        function sendMessage() {
            const message = input.value.trim();
            if (!message) return;

            addMsg(message, 'user');
            input.value = '';

            const loading = addMsg('Thinking...', 'bot loading-indicator');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            fetch('/ai/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': csrfToken },
                body: 'message=' + encodeURIComponent(message)
            })
            .then(r => r.json())
            .then(data => {
                loading.remove();
                addMsg(data.reply || ('Error: ' + (data.error || 'Unknown error')), data.reply ? 'bot' : 'error');
                saveHistory();
            })
            .catch(err => {
                loading.remove();
                addMsg('Error: ' + (err.message || 'Network error'), 'error');
            });
        }

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keypress', function(e) { if (e.key === 'Enter') { e.preventDefault(); sendMessage(); } });
    })();
    </script>
    <?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!-- extra js -->
<!-- <script type="text/javascript" src="/js/jquery-1.8.0.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/jquery.min.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/bootstrap.min.js" 0="yii\web\JqueryAsset"></script>
<script  type="text/javascript" src="/js/bootstrap.js" 0="yii\web\JqueryAsset"></script> -->

<script  type="text/javascript" src="/js/custom.js" 0="yii\web\JqueryAsset"></script>
<!-- <script  type="text/javascript" src="/js/jquery.bracket.min.js" 0="yii\web\JqueryAsset"></script> -->
<script  type="text/javascript" src="/js/jquery.gracket.js" 0="yii\web\JqueryAsset"></script>
