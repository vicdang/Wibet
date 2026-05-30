<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

$this->title = $name;
?>

<div class="error-page">
    <div class="error-container">
        <!-- Error Code -->
        <div class="error-code">
            <?= preg_match('/\d+/', $name, $matches) ? Html::encode($matches[0]) : '⚠' ?>
        </div>

        <!-- Error Title -->
        <h1 class="error-title"><?= Html::encode($name) ?></h1>

        <!-- Error Message -->
        <p class="error-message">
            <?= nl2br(Html::encode($message)) ?>
        </p>

        <!-- Error Details (in development) -->
        <?php if (YII_DEBUG): ?>
            <div class="error-details">
                <details>
                    <summary>Technical Details</summary>
                    <div class="details-content">
                        <pre><?= Html::encode($exception) ?></pre>
                    </div>
                </details>
            </div>
        <?php endif; ?>

        <!-- Helpful Suggestions -->
        <div class="error-suggestions">
            <h3>What you can try:</h3>
            <ul>
                <li>Return to the <?= Html::a('home page', ['/site/index']) ?></li>
                <li>Check if the page URL is correct</li>
                <li>Try refreshing your browser</li>
                <li>Contact support if the problem persists</li>
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="error-actions">
            <?= Html::a('Go Home', ['/site/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Go Back', 'javascript:history.back();', ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>

<style>
.error-page {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 20px;
    background: linear-gradient(135deg, #0a0e1a 0%, #0f1422 100%);
}

[data-theme="light"] .error-page {
    background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%);
}

.error-container {
    max-width: 600px;
    width: 100%;
    text-align: center;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Error Code */
.error-code {
    font-size: 120px;
    font-weight: 900;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 20px;
    line-height: 1;
    letter-spacing: -2px;
}

[data-theme="light"] .error-code {
    background: linear-gradient(135deg, #1f73e6 0%, #7b2fff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Error Title */
.error-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    color: #e8eaf0;
}

[data-theme="light"] .error-title {
    color: #1a1a1a;
}

/* Error Message */
.error-message {
    font-size: 1.1rem;
    color: rgba(232, 234, 240, 0.7);
    margin: 0 0 30px 0;
    line-height: 1.6;
}

[data-theme="light"] .error-message {
    color: rgba(0, 0, 0, 0.7);
}

/* Error Details (Development) */
.error-details {
    margin: 30px 0;
    text-align: left;
}

.error-details summary {
    cursor: pointer;
    padding: 12px 16px;
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 8px;
    background: rgba(0, 212, 255, 0.05);
    color: #00d4ff;
    font-weight: 600;
    transition: all 0.2s ease;
}

[data-theme="light"] .error-details summary {
    background: rgba(31, 115, 230, 0.05);
    border-color: rgba(31, 115, 230, 0.15);
    color: #1f73e6;
}

.error-details summary:hover {
    background: rgba(0, 212, 255, 0.1);
}

.error-details[open] summary {
    background: rgba(0, 212, 255, 0.1);
}

.details-content {
    margin-top: 12px;
    padding: 16px;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    overflow-x: auto;
}

[data-theme="light"] .details-content {
    background: rgba(0, 0, 0, 0.05);
}

.details-content pre {
    margin: 0;
    color: rgba(232, 234, 240, 0.8);
    font-size: 0.85rem;
    white-space: pre-wrap;
    word-wrap: break-word;
}

[data-theme="light"] .details-content pre {
    color: rgba(0, 0, 0, 0.7);
}

/* Suggestions */
.error-suggestions {
    margin: 40px 0;
    padding: 24px;
    background: rgba(0, 212, 255, 0.05);
    border-left: 4px solid #00d4ff;
    border-radius: 8px;
    text-align: left;
}

[data-theme="light"] .error-suggestions {
    background: rgba(31, 115, 230, 0.05);
    border-left-color: #1f73e6;
}

.error-suggestions h3 {
    margin: 0 0 15px 0;
    color: #e8eaf0;
    font-size: 1.1rem;
}

[data-theme="light"] .error-suggestions h3 {
    color: #1a1a1a;
}

.error-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.error-suggestions li {
    padding: 8px 0;
    color: rgba(232, 234, 240, 0.7);
    font-size: 0.95rem;
}

[data-theme="light"] .error-suggestions li {
    color: rgba(0, 0, 0, 0.6);
}

.error-suggestions li:before {
    content: "→ ";
    color: #00d4ff;
    font-weight: bold;
    margin-right: 8px;
}

[data-theme="light"] .error-suggestions li:before {
    color: #1f73e6;
}

.error-suggestions a {
    color: #00d4ff;
    text-decoration: none;
    font-weight: 500;
}

[data-theme="light"] .error-suggestions a {
    color: #1f73e6;
}

.error-suggestions a:hover {
    text-decoration: underline;
}

/* Action Buttons */
.error-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-top: 40px;
}

.btn {
    padding: 12px 28px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.2s ease;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: #0a0e1a;
    box-shadow: 0 4px 15px rgba(0, 212, 255, 0.3);
}

[data-theme="light"] .btn-primary {
    background: linear-gradient(135deg, #1f73e6 0%, #7b2fff 100%);
    color: #ffffff;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
}

.btn-secondary {
    background: transparent;
    color: #00d4ff;
    border: 2px solid #00d4ff;
}

[data-theme="light"] .btn-secondary {
    color: #1f73e6;
    border-color: #1f73e6;
}

.btn-secondary:hover {
    background: rgba(0, 212, 255, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .error-code {
        font-size: 80px;
        margin-bottom: 15px;
    }

    .error-title {
        font-size: 1.75rem;
        margin-bottom: 12px;
    }

    .error-message {
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .error-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }

    .error-suggestions {
        margin: 30px 0;
        padding: 18px;
    }
}
</style>
