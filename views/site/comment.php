<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$this->title = 'Comments';
?>

<style>
/* Modern Comments Page */
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
    max-width: 900px;
    margin: 0 auto;
}

/* Hero Section */
.comments-hero {
    text-align: center;
    margin-bottom: 60px;
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

/* Join Group Card */
.join-group-card {
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.08) 0%, rgba(123, 47, 255, 0.08) 100%);
    border: 2px solid rgba(0, 212, 255, 0.25);
    border-radius: 16px;
    padding: 50px 40px;
    margin-bottom: 60px;
    text-align: center;
    transition: all 0.3s ease;
}

.join-group-card:hover {
    border-color: rgba(0, 212, 255, 0.4);
    box-shadow: 0 12px 40px rgba(0, 212, 255, 0.1);
    transform: translateY(-4px);
}

[data-theme="light"] .join-group-card {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.06) 0%, rgba(66, 133, 244, 0.06) 100%);
    border-color: rgba(31, 115, 230, 0.2);
}

[data-theme="light"] .join-group-card:hover {
    border-color: rgba(31, 115, 230, 0.35);
    box-shadow: 0 12px 40px rgba(31, 115, 230, 0.08);
}

.group-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 24px;
    border-radius: 16px;
    object-fit: cover;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.join-group-card:hover .group-icon {
    transform: scale(1.08);
}

.group-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 12px 0;
    letter-spacing: -0.5px;
}

.group-description {
    font-size: 1rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0 0 32px 0;
    line-height: 1.6;
}

[data-theme="light"] .group-description {
    color: rgba(0, 0, 0, 0.65);
}

.join-btn {
    display: inline-block;
    padding: 14px 40px;
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: #ffffff;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(0, 212, 255, 0.3);
}

.join-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.4);
    text-decoration: none;
}

[data-theme="light"] .join-btn {
    background: linear-gradient(135deg, #1f73e6 0%, #4285f4 100%);
    box-shadow: 0 4px 16px rgba(31, 115, 230, 0.25);
}

[data-theme="light"] .join-btn:hover {
    box-shadow: 0 8px 24px rgba(31, 115, 230, 0.35);
}

/* Comments Section */
.comments-section {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 16px;
    padding: 40px;
    margin-bottom: 40px;
}

[data-theme="light"] .comments-section {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.comments-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 32px 0;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    letter-spacing: -0.5px;
}

/* Disqus Container */
#disqus_thread {
    margin-top: 24px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .site-comments {
        padding: 20px 16px;
    }

    .comments-container {
        max-width: 100%;
    }

    .comments-hero {
        margin-bottom: 40px;
        padding-bottom: 30px;
    }

    .comments-hero h1 {
        font-size: 2rem;
    }

    .comments-hero p {
        font-size: 0.95rem;
    }

    .join-group-card {
        padding: 36px 24px;
        margin-bottom: 40px;
    }

    .group-icon {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }

    .group-title {
        font-size: 1.4rem;
    }

    .group-description {
        font-size: 0.9rem;
        margin-bottom: 24px;
    }

    .join-btn {
        padding: 12px 32px;
        font-size: 0.95rem;
    }

    .comments-section {
        padding: 24px;
    }

    .comments-title {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }
}

@media (max-width: 480px) {
    .site-comments {
        padding: 16px 12px;
    }

    .comments-hero {
        margin-bottom: 36px;
    }

    .comments-hero h1 {
        font-size: 1.6rem;
        margin-bottom: 12px;
    }

    .comments-hero p {
        font-size: 0.9rem;
    }

    .join-group-card {
        padding: 28px 20px;
        margin-bottom: 32px;
    }

    .group-icon {
        width: 90px;
        height: 90px;
        margin-bottom: 16px;
    }

    .group-title {
        font-size: 1.2rem;
    }

    .group-description {
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    .join-btn {
        padding: 11px 28px;
        font-size: 0.9rem;
    }

    .comments-section {
        padding: 20px;
    }

    .comments-title {
        font-size: 1.15rem;
    }
}
</style>

<div class="site-comments">
    <div class="comments-container">
        <!-- Hero Section -->
        <div class="comments-hero">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Join our community and share your thoughts about the World Cup 2026</p>
        </div>

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

        <!-- Comments Section -->
        <div class="comments-section">
            <h2 class="comments-title">💬 Community Comments</h2>
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                (function() {
                    var d = document, s = d.createElement('script');
                    s.src = '//euro2016bet.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>
                <p style="margin: 20px 0; color: rgba(232, 234, 240, 0.7);">
                    Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow" style="color: #00d4ff;">comments powered by Disqus</a>.
                </p>
            </noscript>
        </div>
    </div>
</div>
