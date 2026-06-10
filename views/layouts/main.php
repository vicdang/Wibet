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
            width: 320px;
            max-height: 600px;
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
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.4;
        }

        .ai-chat-message.user {
            background: rgba(0, 212, 255, 0.15);
            color: #e8eaf0;
            align-self: flex-end;
            max-width: 80%;
        }

        [data-theme="light"] .ai-chat-message.user {
            background: rgba(0, 132, 255, 0.15);
            color: #1a1a1a;
        }

        .ai-chat-message.bot {
            background: rgba(255, 255, 255, 0.08);
            color: #e8eaf0;
            align-self: flex-start;
            max-width: 80%;
        }

        [data-theme="light"] .ai-chat-message.bot {
            background: rgba(0, 0, 0, 0.05);
            color: #1a1a1a;
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

    <div class="ai-chat-panel" id="aiChatPanel">
        <div class="ai-chat-header">
            <span class="ai-chat-title">🤖 AI Assistant</span>
            <button class="ai-chat-close" id="aiChatClose">×</button>
        </div>
        <div id="aiMessages" style="flex: 1; overflow-y: auto; padding: 16px; display: flex; flex-direction: column; gap: 10px;"></div>
        <div style="padding: 12px; border-top: 1px solid rgba(0, 212, 255, 0.15); display: flex; gap: 8px;">
            <input type="text" id="aiInput" placeholder="Ask me anything..." style="flex: 1; padding: 8px 12px; border: 1px solid rgba(0, 212, 255, 0.2); border-radius: 6px; background: rgba(0, 0, 0, 0.3); color: #e8eaf0; font-size: 13px;">
            <button id="aiSendBtn" style="width: 36px; height: 36px; padding: 0; background: linear-gradient(135deg, #00d4ff, #7b2fff); border: none; border-radius: 6px; color: white; cursor: pointer; font-size: 16px;">⬆</button>
        </div>
    </div>

    <script>
        (function() {
            const chatBtn = document.getElementById('aiChatBtn');
            const chatPanel = document.getElementById('aiChatPanel');
            const closeBtn = document.getElementById('aiChatClose');
            const messagesDiv = document.getElementById('aiMessages');
            const input = document.getElementById('aiInput');
            const sendBtn = document.getElementById('aiSendBtn');

            let apiKey = '';
            let isFirstOpen = true;

            chatBtn.addEventListener('click', function() {
                chatPanel.classList.toggle('open');
                if (chatPanel.classList.contains('open') && isFirstOpen) {
                    isFirstOpen = false;
                    loadApiKey();
                    addBotMessage('Hello! I can help you with betting rules, match information, team statistics, and tournament details. Ask me anything about World Cup 2026!');
                    input.focus();
                }
            });

            closeBtn.addEventListener('click', function() {
                chatPanel.classList.remove('open');
            });

            document.addEventListener('click', function(event) {
                if (!chatPanel.contains(event.target) && !chatBtn.contains(event.target)) {
                    chatPanel.classList.remove('open');
                }
            });

            function loadApiKey() {
                fetch('/config/get-ai-config', {
                    method: 'GET',
                    headers: {'Content-Type': 'application/json'}
                })
                .then(r => r.json())
                .then(data => {
                    apiKey = data.api_key || '';
                    if (!apiKey) {
                        addBotMessage('⚠️ API key not configured. Please go to /config/index and add your HuggingFace API key.');
                    }
                })
                .catch(e => {
                    console.error('Failed to load API key:', e);
                    addBotMessage('⚠️ Error loading configuration. Please refresh the page.');
                });
            }

            function addBotMessage(text) {
                const msg = document.createElement('div');
                msg.style.cssText = 'background: rgba(255,255,255,0.08); color: #e8eaf0; align-self: flex-start; max-width: 80%; padding: 10px 12px; border-radius: 8px; font-size: 13px; line-height: 1.4;';
                msg.textContent = text;
                messagesDiv.appendChild(msg);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }

            function addUserMessage(text) {
                const msg = document.createElement('div');
                msg.style.cssText = 'background: rgba(0,212,255,0.15); color: #e8eaf0; align-self: flex-end; max-width: 80%; padding: 10px 12px; border-radius: 8px; font-size: 13px; line-height: 1.4;';
                msg.textContent = text;
                messagesDiv.appendChild(msg);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            }

            function callHuggingFaceApi(message) {
                if (!apiKey) {
                    addBotMessage('⚠️ API key not configured. Please set it in /config/index.');
                    return;
                }

                const prompt = 'You are a helpful AI assistant for World Cup 2026 betting application called Wibet. ' +
                    'Answer questions about betting rules, teams, matches, and tournament format. Be concise and friendly. ' +
                    'User question: ' + message;

                const payload = {
                    inputs: prompt,
                    parameters: {max_length: 512, temperature: 0.7}
                };

                addBotMessage('Thinking...');
                const loadingMsg = messagesDiv.lastChild;

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
                        addBotMessage(reply);
                    } else {
                        addBotMessage('Error: Unexpected API response. Please try again.');
                    }
                })
                .catch(e => {
                    loadingMsg.remove();
                    addBotMessage('Error: ' + (e.message || 'Unable to reach AI service. Check your API key.'));
                });
            }

            function sendMessage() {
                const text = input.value.trim();
                if (!text) return;
                addUserMessage(text);
                input.value = '';
                callHuggingFaceApi(text);
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
