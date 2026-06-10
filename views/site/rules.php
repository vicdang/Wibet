<?php
use yii\helpers\Html;
use app\assets\Helper;

$this->title = 'Rules';

$params = Yii::$app->params;
$total = $params['totalAmount'];
$p1 = Helper::calculatePrices($total, $params['p1Rate'], $params['p1Count']);
$p2 = Helper::calculatePrices($total, $params['p2Rate'], $params['p2Count']);
$p3 = Helper::calculatePrices($total, $params['p3Rate'], $params['p3Count']);
$p4 = Helper::calculatePrices($total, $params['p4Rate'], $params['p4Count']);
$p5 = Helper::calculatePrices($total, $params['p5Rate'], $params['p5Count']);
?>

<style scoped>
/* Modern Clean Theme - Scoped to Rules Page */
.site-rules {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    padding: 0 20px 40px 20px;
    min-height: calc(100vh - 100px);
}

[data-theme="light"] .site-rules {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
    --accent: #0084ff;
}

.rules-hero {
    max-width: 1000px;
    margin: 0 auto 60px;
    text-align: center;
    padding: 60px 40px;
    position: relative;
}

.rules-hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin: 0 0 20px 0;
    letter-spacing: -1px;
    line-height: 1.1;
}

.rules-hero p {
    font-size: 1.1rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0;
    line-height: 1.6;
}

[data-theme="light"] .rules-hero h1 {
    color: #1a1a1a;
}

[data-theme="light"] .rules-hero p {
    color: rgba(0, 0, 0, 0.6);
}

.rules-section {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 16px;
    margin-bottom: 50px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
}

.rules-section:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
    transform: translateY(-2px);
}

[data-theme="light"] .rules-section {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.08);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .rules-section:hover {
    border-color: rgba(0, 84, 255, 0.2);
    box-shadow: 0 8px 20px rgba(0, 84, 255, 0.08);
}

.rules-section-header {
    padding: 28px 32px;
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.rules-section-header i {
    font-size: 32px;
    color: #00d4ff;
    flex-shrink: 0;
}

[data-theme="light"] .rules-section-header i {
    color: #0084ff;
}

.rules-section-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.rules-section-content {
    padding: 32px;
}

.rules-section-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.rules-section-content > ul > li {
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
}

.rules-section-content > ul > li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.rules-section-content p {
    margin: 0 0 12px 0;
    line-height: 1.7;
    font-size: 0.95rem;
}

.rules-section-content strong {
    color: #00d4ff;
    font-weight: 600;
}

[data-theme="light"] .rules-section-content strong {
    color: #0084ff;
}

.rules-section-content ul ul {
    margin-top: 16px;
    margin-left: 0;
    padding-left: 0;
}

.rules-section-content ul ul li {
    list-style: none;
    margin-bottom: 10px;
    padding-left: 28px;
    position: relative;
    font-size: 0.92rem;
}

.rules-section-content ul ul li:before {
    content: '→';
    position: absolute;
    left: 8px;
    color: #00d4ff;
    font-weight: bold;
}

[data-theme="light"] .rules-section-content ul ul li:before {
    color: #0084ff;
}

.site-rules .badge {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-block;
    margin: 2px;
    white-space: nowrap;
    letter-spacing: 0.3px;
}

.site-rules .badge-pill {
    border-radius: 20px;
}

.site-rules .badge-primary {
    background: rgba(123, 47, 255, 0.15);
    color: #b8a3ff;
    border: 1px solid rgba(123, 47, 255, 0.3);
}

.site-rules .badge-success {
    background: rgba(76, 175, 80, 0.15);
    color: #81c784;
    border: 1px solid rgba(76, 175, 80, 0.3);
}

.site-rules .badge-info {
    background: rgba(0, 212, 255, 0.15);
    color: #4dd9f0;
    border: 1px solid rgba(0, 212, 255, 0.3);
}

.site-rules .badge-warning {
    background: rgba(255, 193, 7, 0.15);
    color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.site-rules .badge-danger {
    background: rgba(244, 67, 54, 0.15);
    color: #ff7043;
    border: 1px solid rgba(244, 67, 54, 0.3);
}

[data-theme="light"] .site-rules .badge {
    background: rgba(0, 0, 0, 0.04);
    color: #1a1a1a;
}

[data-theme="light"] .site-rules .badge-info {
    color: #0084ff;
}

/* Prize Tier Cards */
.prize-tiers-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 28px;
    margin-top: 40px;
}

.prize-tier-card {
    border-radius: 16px;
    padding: 40px 28px;
    text-align: center;
    border: 2px solid;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    background: var(--card-bg);
}

.prize-tier-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 48px rgba(0, 212, 255, 0.15);
}

.prize-tier-card.diamond {
    border-color: rgba(220, 20, 60, 0.4);
    background: linear-gradient(135deg, rgba(220, 20, 60, 0.08) 0%, rgba(123, 47, 255, 0.08) 100%);
}

.prize-tier-card.platinum {
    border-color: rgba(192, 192, 192, 0.4);
    background: linear-gradient(135deg, rgba(192, 192, 192, 0.08) 0%, rgba(0, 212, 255, 0.08) 100%);
}

.prize-tier-card.gold {
    border-color: rgba(255, 193, 7, 0.4);
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.08) 0%, rgba(255, 140, 0, 0.08) 100%);
}

.prize-tier-card.silver {
    border-color: rgba(169, 169, 169, 0.4);
    background: linear-gradient(135deg, rgba(169, 169, 169, 0.08) 0%, rgba(100, 149, 237, 0.08) 100%);
}

[data-theme="light"] .prize-tier-card {
    background: #f8f9fa;
}

.prize-tier-name {
    font-size: 1.8rem;
    font-weight: 800;
    letter-spacing: 1px;
    margin: 0 0 18px 0;
}

.prize-tier-card.diamond .prize-tier-name { color: #ff6b9d; }
.prize-tier-card.platinum .prize-tier-name { color: #9db4c4; }
.prize-tier-card.gold .prize-tier-name { color: #ffc107; }
.prize-tier-card.silver .prize-tier-name { color: #7c8fa3; }

.prize-tier-count,
.prize-tier-rate,
.prize-tier-value {
    font-size: 0.9rem;
    margin: 10px 0;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    font-weight: 500;
}

.prize-tier-gift {
    margin-top: 28px;
}

.prize-tier-gift img {
    max-width: 85px;
    height: 85px;
    border-radius: 12px;
    border: 2px solid var(--border-color);
    object-fit: cover;
    transition: transform 0.3s ease;
}

.prize-tier-card:hover .prize-tier-gift img {
    transform: scale(1.05);
}

/* Tables */
.rules-table {
    width: 100%;
    background: transparent;
    border-collapse: collapse;
    margin-top: 24px;
    border-radius: 8px;
    overflow: hidden;
    font-size: 0.9rem;
}

.rules-table thead {
    background: rgba(0, 212, 255, 0.08);
    border-bottom: 2px solid rgba(0, 212, 255, 0.2);
}

[data-theme="light"] .rules-table thead {
    background: rgba(0, 84, 255, 0.06);
    border-bottom-color: rgba(0, 84, 255, 0.2);
}

.rules-table th {
    padding: 16px 16px;
    text-align: left;
    color: #00d4ff;
    font-weight: 700;
    letter-spacing: 0.3px;
}

[data-theme="light"] .rules-table th {
    color: #0084ff;
}

.rules-table td {
    padding: 13px 16px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
}

.rules-table tbody tr:hover {
    background: rgba(0, 212, 255, 0.03);
}

[data-theme="light"] .rules-table tbody tr:hover {
    background: rgba(0, 84, 255, 0.03);
}

.rules-table tbody tr:last-child td {
    border-bottom: none;
}

/* Two Column Layout */
.two-column-layout {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 32px;
    margin-top: 32px;
}

.payment-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 28px;
    transition: all 0.3s ease;
}

.payment-card:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.08);
}

[data-theme="light"] .payment-card {
    background: #ffffff;
}

[data-theme="light"] .payment-card:hover {
    border-color: rgba(0, 84, 255, 0.25);
}

.payment-card h4 {
    color: #00d4ff;
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 0 20px 0;
    letter-spacing: 0.3px;
}

[data-theme="light"] .payment-card h4 {
    color: #0084ff;
}

.payment-card .qr-code {
    max-width: 160px;
    border-radius: 10px;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.15));
    margin-top: 20px;
    transition: transform 0.3s ease;
    height: 160px;
    object-fit: cover;
}

.payment-card:hover .qr-code {
    transform: scale(1.02);
}

/* Package Cards Grid */
.package-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-top: 40px;
    padding: 0 8px;
}

.package-card {
    position: relative;
    border-radius: 16px;
    padding: 32px 24px;
    border: 2px solid rgba(0, 212, 255, 0.2);
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.05) 0%, rgba(123, 47, 255, 0.05) 100%);
    transition: all 0.3s ease;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.package-card:hover {
    transform: translateY(-8px);
    border-color: rgba(0, 212, 255, 0.4);
    box-shadow: 0 12px 36px rgba(0, 212, 255, 0.15);
}

/* Package Card Variants */
.package-card.welcome {
    border: 2px solid rgba(76, 175, 80, 0.3);
    background: linear-gradient(135deg, rgba(76, 175, 80, 0.08) 0%, rgba(139, 195, 74, 0.08) 100%);
}

.package-card.welcome:hover {
    border-color: rgba(76, 175, 80, 0.5);
    box-shadow: 0 12px 40px rgba(76, 175, 80, 0.15);
}

.package-card.basic {
    border-color: rgba(100, 200, 255, 0.25);
}

.package-card.recommended {
    border: 2px solid rgba(0, 212, 255, 0.4);
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(123, 47, 255, 0.08) 100%);
    box-shadow: 0 4px 16px rgba(0, 212, 255, 0.12);
}

.package-card.recommended:hover {
    box-shadow: 0 16px 48px rgba(0, 212, 255, 0.2);
}

.package-card.premium {
    border: 2px solid rgba(255, 193, 7, 0.3);
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.08) 0%, rgba(255, 140, 0, 0.08) 100%);
}

.package-card.premium:hover {
    border-color: rgba(255, 193, 7, 0.5);
    box-shadow: 0 12px 40px rgba(255, 193, 7, 0.15);
}

[data-theme="light"] .package-card {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.08);
}

[data-theme="light"] .package-card:hover {
    box-shadow: 0 12px 36px rgba(0, 132, 255, 0.12);
}

[data-theme="light"] .package-card.welcome {
    border-color: rgba(76, 175, 80, 0.25);
}

[data-theme="light"] .package-card.recommended {
    border-color: rgba(0, 132, 255, 0.3);
    box-shadow: 0 4px 16px rgba(0, 132, 255, 0.08);
}

[data-theme="light"] .package-card.premium {
    border-color: rgba(255, 140, 0, 0.25);
}

/* Package Tag */
.package-tag {
    position: absolute;
    top: -12px;
    left: 16px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.welcome-tag {
    background: #4caf50;
    color: #ffffff;
    border: none;
}

.basic-tag {
    background: #64c8ff;
    color: #0a0e1a;
    border: none;
}

.recommended-tag {
    background: #00d4ff;
    color: #0a0e1a;
    border: none;
}

.premium-tag {
    background: #ffc107;
    color: #0a0e1a;
    border: none;
}

[data-theme="light"] .welcome-tag {
    background: #4caf50;
    color: #ffffff;
}

[data-theme="light"] .basic-tag {
    background: #64c8ff;
    color: #0a0e1a;
}

[data-theme="light"] .recommended-tag {
    background: #00d4ff;
    color: #0a0e1a;
}

[data-theme="light"] .premium-tag {
    background: #ffc107;
    color: #0a0e1a;
}

/* Package Icon */
.package-icon {
    font-size: 2.5rem;
}

/* Package Title */
.package-card h4 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 700;
    color: #e8eaf0;
    letter-spacing: 0.3px;
}

[data-theme="light"] .package-card h4 {
    color: #1a1a1a;
}

/* Package Price */
.package-price {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 1.3rem;
    font-weight: 700;
}

.currency-icon {
    font-size: 1.5rem;
}

.price-amount {
    color: #ffc107;
}

[data-theme="light"] .price-amount {
    color: #ff8f00;
}

/* Package Value Section */
.package-value {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 8px;
    padding: 16px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 12px;
}

[data-theme="light"] .package-value {
    background: rgba(0, 0, 0, 0.04);
}

.base-hearts {
    font-size: 0.9rem;
    color: rgba(232, 234, 240, 0.5);
    min-height: 24px;
}

[data-theme="light"] .base-hearts {
    color: rgba(0, 0, 0, 0.4);
}

.actual-hearts {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.hearts-amount {
    font-size: 1.5rem;
    font-weight: 800;
    color: #ff6b9d;
}

.bonus-badge {
    padding: 4px 10px;
    background: rgba(76, 175, 80, 0.2);
    color: #81c784;
    border: 1px solid rgba(76, 175, 80, 0.4);
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 700;
}

[data-theme="light"] .bonus-badge {
    background: rgba(76, 175, 80, 0.15);
    color: #34a853;
    border-color: rgba(76, 175, 80, 0.3);
}

/* Alert Boxes */
.rules-alert {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    border-left: 4px solid #ffc107;
    border-radius: 10px;
    padding: 24px 28px;
    margin: 24px 0;
    color: #ffc107;
    font-size: 0.95rem;
}

.rules-alert strong {
    color: #ffd700;
    font-weight: 700;
}

.rules-alert-danger {
    background: rgba(244, 67, 54, 0.1);
    border-color: rgba(244, 67, 54, 0.3);
    border-left-color: #f44336;
    color: #ff8a80;
}

.rules-alert-danger strong {
    color: #ff5252;
    font-weight: 700;
}

[data-theme="light"] .rules-alert {
    background: rgba(255, 193, 7, 0.08);
    color: #ff8f00;
}

[data-theme="light"] .rules-alert-danger {
    background: rgba(244, 67, 54, 0.08);
    color: #d32f2f;
}

/* Closing Section */
.rules-closing {
    max-width: 900px;
    margin: 80px auto 0;
    background: linear-gradient(135deg, rgba(255, 140, 0, 0.1) 0%, rgba(220, 20, 60, 0.1) 100%);
    border: 2px solid rgba(255, 140, 0, 0.25);
    border-radius: 16px;
    padding: 60px 40px;
    text-align: center;
}

[data-theme="light"] .rules-closing {
    background: linear-gradient(135deg, rgba(255, 140, 0, 0.05) 0%, rgba(220, 20, 60, 0.05) 100%);
    border-color: rgba(255, 140, 0, 0.2);
}

.rules-closing h5 {
    color: #ffc107;
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 0 16px 0;
    letter-spacing: 0.5px;
}

[data-theme="light"] .rules-closing h5 {
    color: #ff8f00;
}

.rules-closing h3 {
    color: #ffffff;
    font-size: 1.6rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    margin: 24px 0 0 0;
}

[data-theme="light"] .rules-closing h3 {
    color: #1a1a1a;
}

.rules-closing p {
    line-height: 1.8;
    font-size: 0.95rem;
    margin: 16px 0;
}

.rules-closing a {
    font-weight: 700;
    transition: all 0.3s ease;
}

.rules-closing .signature {
    margin-top: 48px;
    padding-top: 32px;
    border-top: 2px solid rgba(255, 140, 0, 0.25);
}

.rules-closing .signature p {
    margin: 8px 0;
    font-size: 0.9rem;
}

.rules-closing .signature strong {
    color: #ffc107;
    font-weight: 700;
}

[data-theme="light"] .rules-closing .signature strong {
    color: #ff8f00;
}

/* Responsive */
@media (max-width: 1024px) {
    .site-rules {
        padding: 0 16px 30px 16px;
    }

    .rules-hero {
        padding: 50px 24px;
    }

    .rules-section-content {
        padding: 24px;
    }
}

@media (max-width: 768px) {
    .site-rules {
        padding: 0 12px 20px 12px;
    }

    .rules-hero {
        padding: 40px 20px;
        margin-bottom: 40px;
    }

    .rules-hero h1 {
        font-size: 2.2rem;
    }

    .rules-section {
        margin-bottom: 36px;
    }

    .rules-section-header {
        padding: 20px 24px;
    }

    .rules-section-header i {
        font-size: 28px;
    }

    .rules-section-header h3 {
        font-size: 1.2rem;
    }

    .rules-section-content {
        padding: 20px 24px;
    }

    .rules-section-content > ul > li {
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .prize-tiers-container {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .two-column-layout {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .rules-table {
        font-size: 0.8rem;
    }

    .rules-table th,
    .rules-table td {
        padding: 10px 12px;
    }

    .rules-closing {
        padding: 40px 24px;
        margin-top: 60px;
    }

    .rules-closing h3 {
        font-size: 1.3rem;
    }

    .badge {
        padding: 4px 10px;
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .site-rules {
        padding: 0 12px 20px 12px;
    }

    .rules-hero {
        padding: 30px 16px;
        margin-bottom: 30px;
    }

    .rules-hero h1 {
        font-size: 1.8rem;
        margin-bottom: 12px;
    }

    .rules-hero p {
        font-size: 0.9rem;
    }

    .rules-section-header {
        padding: 16px 20px;
        gap: 12px;
    }

    .rules-section-header i {
        font-size: 24px;
    }

    .rules-section-header h3 {
        font-size: 1rem;
    }

    .rules-section-content {
        padding: 16px 20px;
    }

    .rules-section-content > ul > li {
        margin-bottom: 16px;
        padding-bottom: 16px;
    }

    .rules-section-content p {
        font-size: 0.9rem;
    }

    .prize-tier-card {
        padding: 28px 16px;
    }

    .prize-tier-name {
        font-size: 1.4rem;
        margin-bottom: 12px;
    }

    .rules-closing {
        padding: 28px 16px;
        margin-top: 40px;
    }

    .rules-closing h5 {
        font-size: 1rem;
    }

    .rules-closing h3 {
        font-size: 1.1rem;
    }

    .rules-closing p {
        font-size: 0.85rem;
    }
}

/* Countdown Section */
.countdown-section {
    background: rgba(0, 0, 0, 0.9);
    padding: 40px 20px;
    border-radius: 8px;
    margin-bottom: 60px;
}

[data-theme="light"] .countdown-section {
    background: rgba(0, 0, 0, 0.05);
}

/* Stats Header Grid */
.stats-header {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 50px 0;
    background: rgba(0, 0, 0, 0.9);
    padding: 40px 20px;
    border-radius: 8px;
}

[data-theme="light"] .stats-header {
    background: rgba(0, 0, 0, 0.05);
}

</style>

<div class="site-rules">
    <!-- Hero Banner -->
    <div class="rules-hero">
        <h1>🏆⚽ THỂ LỆ TRÒ CHƠI ⚽🏆</h1>
        <p><?= $params['appName'] ?> – Sân chơi dự đoán tỉ số giải trí cho tập thể • <?= $params['seasonName'] ?></p>
    </div>

    <div class="container">
        <!-- Important Notice -->
        <div class="rules-section" style="margin-bottom: 50px; margin-top: 20px; border-color: rgba(0, 212, 255, 0.4); background: linear-gradient(135deg, rgba(0, 212, 255, 0.05) 0%, rgba(123, 47, 255, 0.05) 100%);">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-info-sign"></i>
                <h3>LƯU Ý QUAN TRỌNG ⚽🏆</h3>
            </div>
            <div class="rules-section-content">
                <p>Game sử dụng <b>❤️</b> được cấp và cộng trừ dựa trên số ❤️ của mỗi account, <b>KHÔNG quy đổi thành tiền mặt</b> và <b>KHÔNG mang tính chất đánh bạc</b> dưới mọi hình thức.</p>
                <p style="margin-top: 16px; font-size: 1.05rem;"><b>Tất cả vì niềm vui bóng đá và những phần quà tinh thần hấp dẫn!</b></p>
            </div>
        </div>

        <!-- Participation & Tournament Structure -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-globe"></i>
                <h3>ĐỐI TƯỢNG & CẤU TRÚC GIẢI ĐẤU</h3>
            </div>
            <div class="rules-section-content">
                <ul>
                    <li>
                        <p><b>Đối tượng tham gia:</b> Toàn thể thành viên (Có thể tham gia theo tư cách <b>Cá nhân</b> hoặc <b>Nhóm</b>)</p>
                    </li>
                    <li>
                        <p><b>Cách đăng ký:</b> Liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>" style="color:#00d4ff;">Admin <?= $params['adminName'] ?></a></b> và cung cấp Email để được kích hoạt tài khoản</p>
                    </li>
                    <li>
                        <p><b>Giới hạn tài khoản:</b> Được tạo tối đa <span class="badge badge-info">2 tài khoản</span> cho mỗi <b>người chơi</b> hoặc <b>nhóm</b></p>
                    </li>
                    <li>
                        <p><b>Lộ trình thi đấu – 4 Vòng độc lập:</b> Để tăng cơ hội cho mọi người, giải đấu được chia làm <b>4 vòng</b>. Kết quả và giải thưởng sẽ được chốt riêng sau mỗi vòng:</p>
                        <ul>
                            <li><p><span class="badge badge-primary">Vòng 1</span> – Dự đoán các trận đấu thuộc <b>Lượt trận 1 - Vòng bảng</b></p></li>
                            <li><p><span class="badge badge-primary">Vòng 2</span> – Dự đoán các trận đấu thuộc <b>Lượt trận 2 - Vòng bảng</b></p></li>
                            <li><p><span class="badge badge-primary">Vòng 3</span> – Dự đoán các trận đấu thuộc <b>Lượt trận 3 - Vòng bảng</b></p></li>
                            <li><p><span class="badge badge-success">Vòng 4</span> – Dự đoán các trận đấu từ <b>Vòng Knock-out (1/8) cho đến trận Chung kết</b></p></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Scoring Mechanism -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-stats"></i>
                <h3>CƠ CHẾ TRÒ CHƠI</h3>
            </div>
            <div class="rules-section-content">
                <ul>
                    <li>
                        <p><b>Khởi đầu:</b> Mỗi tài khoản khi được kích hoạt sẽ nhận <span class="badge badge-warning">Gói Chào Đời 👶</span> để tham gia dự đoán trong mỗi vòng</p>
                    </li>
                    <li>
                        <p><b>Cơ chế Hồi Máu:</b> Nếu số ❤️ tụt xuống dưới <span class="badge badge-danger">50❤️</span>, bạn sẽ được quyền sử dụng <span class="badge badge-success">DỊCH VỤ HỒI MÁU</span> để tiếp tục chơi</p>
                    </li>
                    <li>
                        <p><b>Giới hạn hồi máu:</b> Được hồi máu tối đa <span class="badge badge-warning">3 lần</span> trong mỗi vòng đấu. Hãy tính toán chiến thuật hợp lý!</p>
                    </li>
                    <li>
                        <p><b>Mỗi lần hồi máu:</b> Nhận thêm <span class="badge badge-success">200❤️</span> để tiếp tục dự đoán</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ❤️ Packages -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-credit-card"></i>
                <h3>DỊCH VỤ HỒI MÁU</h3>
            </div>
            <div class="rules-section-content">
                <!-- <p>Ngoài điểm khởi đầu, bạn có thể hồi máu bằng các gói sau:</p> -->

                <div class="package-grid">
                    <!-- Gói Chào Đời (Welcome) -->
                    <div class="package-card welcome">
                        <div class="package-tag welcome-tag">🎉 Kích hoạt</div>
                        <div class="package-icon">👶</div>
                        <h4>Gói Chào Đời</h4>
                        <!-- <p style="font-size: 0.85rem; color: rgba(232, 234, 240, 0.7); margin: 0;">Kích hoạt tài khoản</p> -->
                        <div class="package-price">
                            <span class="currency-icon">💰</span>
                            <span class="price-amount">200K</span>
                        </div>
                        <div class="package-value">
                            <div class="base-hearts"><span style="text-decoration: line-through; opacity: 0.6;">200 ❤️</span></div>
                            <div class="actual-hearts">
                                <span class="hearts-amount">200❤️</span>
                                <!-- <span class="bonus-badge">1:1</span> -->
                            </div>
                        </div>
                    </div>

                    <!-- Gói Sơ Cứu -->
                    <div class="package-card basic">
                        <div class="package-tag basic-tag">Cơ Bản</div>
                        <div class="package-icon">🩹</div>
                        <h4>Gói Sơ Cứu</h4>
                        <div class="package-price">
                            <span class="currency-icon">💰</span>
                            <span class="price-amount">99K</span>
                        </div>
                        <div class="package-value">
                            <div class="base-hearts"><span style="text-decoration: line-through; opacity: 0.6;">99 ❤️</span></div>
                            <div class="actual-hearts">
                                <span class="hearts-amount">100❤️</span>
                                <span class="bonus-badge">+1%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gói Cấp Cứu (Recommended) -->
                    <div class="package-card recommended">
                        <div class="package-tag recommended-tag">⭐ Khuyên Dùng</div>
                        <div class="package-icon">🚑</div>
                        <h4>Gói Cấp Cứu</h4>
                        <div class="package-price">
                            <span class="currency-icon">💰</span>
                            <span class="price-amount">149K</span>
                        </div>
                        <div class="package-value">
                            <div class="base-hearts"><span style="text-decoration: line-through; opacity: 0.6;">149 ❤️</span></div>
                            <div class="actual-hearts">
                                <span class="hearts-amount">160❤️</span>
                                <span class="bonus-badge">+7%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gói ICU (Best Value) -->
                    <div class="package-card premium">
                        <div class="package-tag premium-tag">🔥 Siêu Lợi</div>
                        <div class="package-icon">🏥</div>
                        <h4>Gói ICU</h4>
                        <div class="package-price">
                            <span class="currency-icon">💰</span>
                            <span class="price-amount">199K</span>
                        </div>
                        <div class="package-value">
                            <div class="base-hearts"><span style="text-decoration: line-through; opacity: 0.6;">199 ❤️</span></div>
                            <div class="actual-hearts">
                                <span class="hearts-amount">250❤️</span>
                                <span class="bonus-badge">+26%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px; padding: 24px; background: rgba(0, 212, 255, 0.08); border-left: 4px solid #00d4ff; border-radius: 8px; text-align: center;">
                    <p style="margin: 0; font-size: 1.1rem; font-weight: 700; letter-spacing: 0.5px;">
                        <strong>Quy Đổi:</strong> <span style="color: #ff6b9d; font-size: 1.2rem;">1K = 1❤️</span>
                    </p>
                </div>

                <!-- Payment Gateway Hours -->
                <div style="margin-top: 30px; padding: 28px; background: linear-gradient(135deg, rgba(255, 193, 7, 0.08) 0%, rgba(255, 140, 0, 0.08) 100%); border: 2px solid rgba(255, 193, 7, 0.3); border-radius: 12px;">
                    <p style="margin: 0 0 20px 0; font-size: 1.1rem; font-weight: 700; color: #ffc107; display: flex; align-items: center; gap: 10px;">
                        <i class="glyphicon glyphicon-time" style="font-size: 1.3rem;"></i> GIỜ HOẠT ĐỘNG CỔNG THANH TOÁN
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 16px; margin-top: 16px;">
                        <div style="padding: 14px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; border-left: 3px solid #ffc107;">
                            <p style="margin: 0 0 6px 0; font-size: 0.95rem; color: rgba(232, 234, 240, 0.8);"><strong>💳 Cổng thanh toán mở:</strong> <span style="color: #ffc107; font-weight: 700;">09:00 - 22:30</span> hàng ngày</p>
                        </div>
                        <div style="padding: 14px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; border-left: 3px solid #ff8a65;">
                            <p style="margin: 0 0 6px 0; font-size: 0.95rem; color: rgba(232, 234, 240, 0.8);"><strong>🔄 Giao dịch sau 22:30:</strong> Xử lý vào <span style="color: #ff8a65; font-weight: 700;">09:00 ngày hôm sau</span></p>
                        </div>
                        <div style="padding: 14px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; border-left: 3px solid #ff6b6b;">
                            <p style="margin: 0 0 6px 0; font-size: 0.95rem; color: rgba(232, 234, 240, 0.8);"><strong>⛔ Ngưng giao dịch:</strong> Toàn bộ giao dịch dừng lại <span style="color: #ff6b6b; font-weight: 700;">22:30 trước 3 ngày</span> kết thúc vòng cuối</p>
                        </div>
                        <div style="padding: 14px; background: rgba(76, 175, 80, 0.1); border-radius: 8px; border-left: 3px solid #81c784; margin-top: 8px;">
                            <p style="margin: 0; font-size: 0.9rem; color: #81c784; font-weight: 600;"><i class="glyphicon glyphicon-ok-circle"></i> Đảm bảo quyền lợi cho account tham gia từ đầu</p>
                        </div>
                    </div>
                </div>

                <div class="rules-alert" style="margin-top: 30px;">
                    <p><strong><i class="glyphicon glyphicon-info-sign"></i> THÔNG TIN</strong></p>
                    <p>Liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>" style="color:#00d4ff;">Admin <?= $params['adminName'] ?></a></b> để hồi máu hoặc đăng ký tài khoản</p>
                </div>
            </div>
        </div>

        <!-- Prize Structure -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-star"></i>
                <h3>CƠ CẤU GIẢI THƯỞNG (TỪNG VÒNG ĐẤU)</h3>
            </div>
            <div class="rules-section-content">
                <p>Sau mỗi vòng đấu, Ban tổ chức sẽ chốt bảng xếp hạng điểm số từ cao xuống thấp để trao các giải thưởng hấp dẫn:</p>

                <table class="rules-table">
                    <thead>
                        <tr>
                            <th>Hạng Giải</th>
                            <th>Số Lượng</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>🥇 Giải Nhất</b></td>
                            <td><span class="badge badge-warning">01 giải</span></td>
                            <td>Dành cho người/nhóm có số điểm cao nhất vòng</td>
                        </tr>
                        <tr>
                            <td><b>🥈 Giải Nhì</b></td>
                            <td><span class="badge badge-warning">02 giải</span></td>
                            <td>Dành cho 2 người/nhóm có số điểm cao tiếp theo</td>
                        </tr>
                        <tr>
                            <td><b>🥉 Giải Ba</b></td>
                            <td><span class="badge badge-warning">03 giải</span></td>
                            <td>Dành cho 3 người/nhóm xếp kế tiếp</td>
                        </tr>
                        <tr>
                            <td><b>🎁 Giải Khuyến Khích</b></td>
                            <td><span class="badge badge-info">Linh Hoạt</span></td>
                            <td>Số lượng tùy thuộc vào tình hình thực tế của mỗi vòng</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Rules & Regulations -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-certificate"></i>
                <h3>CÁC QUY ĐỊNH KHÁC</h3>
            </div>
            <div class="rules-section-content">
                <ul>
                    <li>
                        <p>Mỗi account tham gia tối thiểu <b>4 trận đấu</b>, mỗi trận tối thiểu <span class="badge badge-success">50 ❤️</span> để đủ điều kiện xét giải trong mỗi vòng</p>
                        <p style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); margin-top: 10px;"><i class="glyphicon glyphicon-info-sign"></i> <b>Lưu ý:</b> Có thể đặt lẻ, ví dụ: <span class="badge badge-info">51 ❤️</span>, <span class="badge badge-info">49 ❤️</span>, v.v.</p>
                    </li>
                    <li>
                        <p>Mọi hành vi gian lận (nếu bị phát hiện) sẽ dẫn đến <b style="color:#ff5252;">HỦY TƯ CÁCH THAM GIA</b> ngay lập tức</p>
                    </li>
                    <li>
                        <p><b>Email & Tên người chơi không giới hạn:</b> Ví dụ: <span style="background: rgba(0, 212, 255, 0.1); padding: 4px 8px; border-radius: 4px;">Tên: Man Văn Bét • Account: mvbet • NickName: Bét Man</span></p>
                    </li>
                    <li>
                        <p><b>Tái sử dụng tài khoản từ vòng Bảng:</b> Nếu đã tạo tài khoản ở vòng Bảng, tái sử dụng để được ưu đãi <span class="badge badge-warning">TRI ÂN BET THỦ</span></p>
                    </li>
                    <li>
                        <p><b>Luật ưu tiên khi bằng điểm:</b> Nếu 2+ người bằng điểm → áp dụng thứ tự ưu tiên:</p>
                        <ul style="margin-top: 12px;">
                            <li><p><span class="badge badge-success">1️⃣</span> <b>Tổng điểm</b> – Tổng điểm cao hơn</p></li>
                            <li><p><span class="badge badge-info">2️⃣</span> <b>Số lần dự đoán</b> – Tham gia nhiều trận hơn</p></li>
                            <li><p><span class="badge badge-primary">3️⃣</span> <b>Số lần thắng</b> – Số dự đoán chính xác hơn</p></li>
                        </ul>
                    </li>
                    <li>
                        <p><b>Quỹ tập thể (Team):</b> Khuyến khích các quỹ tập thể tham gia với <b>tên Team</b> tương ứng (ví dụ: "Team XYZ", "Group ABC")</p>
                    </li>
                    <li>
                        <p>Trong trường hợp có tranh chấp hoặc bằng điểm, quyết định cuối cùng thuộc về <b>Ban Tổ Chức</b></p>
                    </li>
                    <li>
                        <p>Tinh thần chung của trò chơi: <b style="color:#ffd700;">"VUI LÀ CHÍNH"</b> 🎉 – Hãy tôn trọng tinh thần gắn kết tập thể</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contact & Refill Section -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-phone"></i>
                <h3>LIÊN HỆ & HỒI MÁU</h3>
            </div>
            <div class="rules-section-content">
                <!-- Admin Contact -->
                <div style="padding: 20px; background: rgba(76, 175, 80, 0.1); border-left: 4px solid #81c784; border-radius: 8px; margin-bottom: 30px;">
                    <p style="margin: 0; font-size: 1.1rem; font-weight: 700; color: #81c784;">
                        <i class="glyphicon glyphicon-user"></i> Liên hệ <b>Admin Giàu Võ</b> để nạp tiền và tạo Account
                    </p>
                </div>

                <!-- Payment Methods -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 40px;">
                    <!-- Bank Transfer -->
                    <div style="padding: 20px; background: rgba(0, 150, 255, 0.1); border: 1px solid rgba(0, 150, 255, 0.3); border-radius: 12px;">
                        <p style="margin: 0 0 16px 0; font-size: 1.05rem; font-weight: 700; color: #0096ff;">
                            🏦 Chuyển khoản Ngân hàng
                        </p>
                        <div style="font-size: 0.95rem; line-height: 1.8;">
                            <p style="margin: 0;"><b>Tên:</b> VO NGOC GIAU</p>
                            <p style="margin: 0;"><b>STK:</b> <span style="background: rgba(255,255,255,0.1); padding: 2px 6px; border-radius: 3px;">1440216948</span></p>
                            <p style="margin: 0;"><b>Ngân hàng:</b> BIDV CN TN TpHCM</p>
                            <p style="margin: 8px 0 0 0; font-size: 0.9rem; color: rgba(232,234,240,0.7);"><b>Nội dung:</b></p>
                            <p style="margin: 4px 0 0 0; background: rgba(0,0,0,0.2); padding: 8px; border-radius: 4px; font-family: monospace; font-size: 0.85rem;">[Account]_[nickname]_[Họ Tên]_wb<br>mvbet_Betman_Bét Man_wb</p>
                        </div>
                    </div>

                    <!-- MoMo Payment -->
                    <div style="padding: 20px; background: rgba(233, 30, 99, 0.1); border: 1px solid rgba(233, 30, 99, 0.3); border-radius: 12px;">
                        <p style="margin: 0 0 16px 0; font-size: 1.05rem; font-weight: 700; color: #e91e63;">
                            📱 MoMo
                        </p>
                        <div style="font-size: 0.95rem; line-height: 1.8;">
                            <p style="margin: 0;"><b>Tên:</b> Võ Ngọc Giàu</p>
                            <p style="margin: 0;"><b>MoMo:</b> <span style="background: rgba(255,255,255,0.1); padding: 2px 6px; border-radius: 3px;">0834020737</span></p>
                            <p style="margin: 0;"><b>Skype:</b> Giàu Võ</p>
                            <p style="margin: 8px 0 0 0; font-size: 0.9rem; color: rgba(232,234,240,0.7);"><b>Nội dung:</b></p>
                            <p style="margin: 4px 0 0 0; background: rgba(0,0,0,0.2); padding: 8px; border-radius: 4px; font-family: monospace; font-size: 0.85rem;">[Account]_[nickname]_[Họ Tên]_wb<br>mvbet_Betman_Bét Man_wb</p>
                        </div>
                    </div>
                </div>

                <!-- Authentication Guarantee -->
                <div style="padding: 20px; background: rgba(255, 193, 7, 0.1); border-left: 4px solid #ffc107; border-radius: 8px; margin-bottom: 30px;">
                    <p style="margin: 0 0 16px 0; font-size: 1.05rem; font-weight: 700; color: #ffc107;">
                        ✅ ĐẢM BẢO XÁC THỰC
                    </p>
                    <div style="font-size: 0.95rem; line-height: 1.8;">
                        <p style="margin: 0;"><b>Người chơi mới:</b></p>
                        <ul style="margin: 8px 0 16px 20px;">
                            <li>Liên hệ Admin Giàu Võ để tạo account hoặc hồi máu</li>
                            <li>Admin tạo account & gửi username/password</li>
                            <li>Đổi password tại <b>Change Password</b> & Login</li>
                        </ul>

                        <p style="margin: 16px 0 0 0;"><b>Account cũ:</b></p>
                        <ul style="margin: 8px 0 0 20px;">
                            <li><b>Ting ting</b> → account sẽ được hồi sinh</li>
                            <li style="color: #ff6b6b;"><b style="color: #ff6b6b;">⚠️ Account mới sẽ KHÔNG được ưu đãi TRI ÂN BET THỦ</b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wibet Loyalty Program -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-star"></i>
                <h3>🙏 TRI ÂN WIBET</h3>
            </div>
            <div class="rules-section-content">
                <p style="margin-bottom: 24px; font-size: 0.95rem; line-height: 1.8;">
                    Nhằm tri ân những Accounts tham gia <b>Vòng Bảng (VB)</b>, mỗi account cũ tạo ở <b>Vòng Loại Trực Tiếp (LTT)</b> được ưu đãi:
                </p>

                <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">
                    <!-- Tier 1 -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(139, 195, 74, 0.1) 100%); border: 2px solid rgba(76, 175, 80, 0.3); border-radius: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="font-size: 1.3rem;">🥉</span>
                            <span style="font-size: 1.1rem; font-weight: 700; color: #81c784;">Tier 1: Hồi máu đạt 400❤️</span>
                        </div>
                        <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 8px;">
                            <p style="margin: 0; font-size: 0.95rem;">
                                Tặng thêm <span style="background: rgba(76, 175, 80, 0.2); padding: 2px 6px; border-radius: 3px; font-weight: 700; color: #81c784;">20% lần hồi sinh đầu tiên</span>
                            </p>
                            <p style="margin: 8px 0 0 0; font-size: 0.95rem; color: rgba(232, 234, 240, 0.8);">
                                <span style="background: rgba(0,0,0,0.2); padding: 4px 8px; border-radius: 3px; font-family: monospace;">+60❤️ = 360❤️</span>
                            </p>
                        </div>
                    </div>

                    <!-- Tier 2 -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(192, 192, 192, 0.1) 0%, rgba(158, 158, 158, 0.1) 100%); border: 2px solid rgba(192, 192, 192, 0.3); border-radius: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="font-size: 1.3rem;">🥈</span>
                            <span style="font-size: 1.1rem; font-weight: 700; color: #b0b0b0;">Tier 2: Hồi máu đạt 600❤️</span>
                        </div>
                        <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 8px;">
                            <p style="margin: 0; font-size: 0.95rem;">
                                Tặng thêm <span style="background: rgba(192, 192, 192, 0.2); padding: 2px 6px; border-radius: 3px; font-weight: 700; color: #b0b0b0;">30% lần hồi sinh đầu tiên</span>
                            </p>
                            <p style="margin: 8px 0 0 0; font-size: 0.95rem; color: rgba(232, 234, 240, 0.8);">
                                <span style="background: rgba(0,0,0,0.2); padding: 4px 8px; border-radius: 3px; font-family: monospace;">+90❤️ = 390❤️</span>
                            </p>
                        </div>
                    </div>

                    <!-- Tier 3 -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 140, 0, 0.1) 100%); border: 2px solid rgba(255, 193, 7, 0.3); border-radius: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <span style="font-size: 1.3rem;">🥇</span>
                            <span style="font-size: 1.1rem; font-weight: 700; color: #ffc107;">Tier 3: Hồi máu đạt 800❤️</span>
                        </div>
                        <div style="background: rgba(255,255,255,0.05); padding: 14px; border-radius: 8px;">
                            <p style="margin: 0; font-size: 0.95rem;">
                                Tặng thêm <span style="background: rgba(255, 193, 7, 0.2); padding: 2px 6px; border-radius: 3px; font-weight: 700; color: #ffc107;">50% lần hồi sinh đầu tiên</span>
                            </p>
                            <p style="margin: 8px 0 0 0; font-size: 0.95rem; color: rgba(232, 234, 240, 0.8);">
                                <span style="background: rgba(0,0,0,0.2); padding: 4px 8px; border-radius: 3px; font-family: monospace;">+150❤️ = 450❤️</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 24px; padding: 16px; background: rgba(0, 212, 255, 0.08); border-left: 4px solid #00d4ff; border-radius: 8px;">
                    <p style="margin: 0; font-size: 0.9rem; color: rgba(232, 234, 240, 0.8);">
                        <i class="glyphicon glyphicon-info-sign"></i> <b>Lưu ý:</b> Ưu đãi áp dụng cho <b>lần hồi sinh đầu tiên</b> sau khi tạo account mới từ account cũ (Vòng Bảng)
                    </p>
                </div>
            </div>
        </div>

        <!-- Access Levels Per Round -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-lock"></i>
                <h3>MỨC ĐỘ TRUY CẬP MỖI VÒNG</h3>
            </div>
            <div class="rules-section-content">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                        <thead>
                            <tr style="background: rgba(0, 212, 255, 0.15); border-bottom: 2px solid rgba(0, 212, 255, 0.3);">
                                <th style="padding: 14px; text-align: left; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.2);">Mục</th>
                                <th style="padding: 14px; text-align: left; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.2);">Chi tiết</th>
                                <th style="padding: 14px; text-align: center; font-weight: 700; color: #81c784; border-right: 1px solid rgba(0, 212, 255, 0.2);">VB<br><span style="font-size: 0.8rem; font-weight: 400; color: rgba(232, 234, 240, 0.7);">Vòng Bảng</span></th>
                                <th style="padding: 14px; text-align: center; font-weight: 700; color: #ff6b6b;">LTT<br><span style="font-size: 0.8rem; font-weight: 400; color: rgba(232, 234, 240, 0.7);">Loại Trực Tiếp</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ranking Section -->
                            <tr style="border-bottom: 1px solid rgba(0, 212, 255, 0.1);">
                                <td style="padding: 14px; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.1);">Ranking</td>
                                <td style="padding: 14px; border-right: 1px solid rgba(0, 212, 255, 0.1);">Xem lịch sử cược của người khác</td>
                                <td style="padding: 14px; text-align: center; border-right: 1px solid rgba(0, 212, 255, 0.1);"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                                <td style="padding: 14px; text-align: center;"><span style="background: rgba(244, 67, 54, 0.2); color: #ff6b6b; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✗ Không</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(0, 212, 255, 0.1); background: rgba(0, 212, 255, 0.05);">
                                <td style="padding: 14px; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.1);">Ranking</td>
                                <td style="padding: 14px; border-right: 1px solid rgba(0, 212, 255, 0.1);">Xem info cơ bản (điểm hiện tại & đã cược)</td>
                                <td style="padding: 14px; text-align: center; border-right: 1px solid rgba(0, 212, 255, 0.1);"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                                <td style="padding: 14px; text-align: center;"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                            </tr>

                            <!-- Matches Section -->
                            <tr style="border-bottom: 1px solid rgba(0, 212, 255, 0.1);">
                                <td style="padding: 14px; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.1);">Matches</td>
                                <td style="padding: 14px; border-right: 1px solid rgba(0, 212, 255, 0.1);">Xem tỉ lệ cược & tỉ lệ chọi</td>
                                <td style="padding: 14px; text-align: center; border-right: 1px solid rgba(0, 212, 255, 0.1);"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                                <td style="padding: 14px; text-align: center;"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(0, 212, 255, 0.1); background: rgba(0, 212, 255, 0.05);">
                                <td style="padding: 14px; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.1);">Matches</td>
                                <td style="padding: 14px; border-right: 1px solid rgba(0, 212, 255, 0.1);">Xem danh sách người chơi tham gia</td>
                                <td style="padding: 14px; text-align: center; border-right: 1px solid rgba(0, 212, 255, 0.1);"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                                <td style="padding: 14px; text-align: center;"><span style="background: rgba(244, 67, 54, 0.2); color: #ff6b6b; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✗ Không</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(0, 212, 255, 0.1);">
                                <td style="padding: 14px; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.1);">Matches</td>
                                <td style="padding: 14px; border-right: 1px solid rgba(0, 212, 255, 0.1);">Xem & chỉnh sửa cược bản thân</td>
                                <td style="padding: 14px; text-align: center; border-right: 1px solid rgba(0, 212, 255, 0.1);"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                                <td style="padding: 14px; text-align: center;"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(0, 212, 255, 0.1); background: rgba(0, 212, 255, 0.05);">
                                <td style="padding: 14px; font-weight: 700; color: #00d4ff; border-right: 1px solid rgba(0, 212, 255, 0.1);">Matches</td>
                                <td style="padding: 14px; border-right: 1px solid rgba(0, 212, 255, 0.1);">Xem chi tiết cược trận đang đấu</td>
                                <td style="padding: 14px; text-align: center; border-right: 1px solid rgba(0, 212, 255, 0.1);"><span style="background: rgba(76, 175, 80, 0.2); color: #81c784; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✓ Có</span></td>
                                <td style="padding: 14px; text-align: center;"><span style="background: rgba(244, 67, 54, 0.2); color: #ff6b6b; padding: 4px 10px; border-radius: 4px; font-weight: 700;">✗ Không</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="padding: 16px; background: rgba(0, 212, 255, 0.08); border-left: 4px solid #00d4ff; border-radius: 8px;">
                    <p style="margin: 0; font-size: 0.9rem;"><i class="glyphicon glyphicon-info-sign"></i> <b>VB:</b> Vòng Bảng (Group Stage) | <b>LTT:</b> Vòng Loại Trực Tiếp (Knockout Stage)</p>
                </div>
            </div>
        </div>

        <!-- Beginner's Guide -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-book"></i>
                <h3>📚 HƯỚNG DẪN TÂN THỦ</h3>
            </div>
            <div class="rules-section-content">
                <p style="margin-bottom: 24px; font-size: 0.95rem; line-height: 1.8;">
                    Chương trình hỗ trợ kèo: <span style="background: rgba(0, 212, 255, 0.15); padding: 2px 6px; border-radius: 3px;">0</span>, <span style="background: rgba(0, 212, 255, 0.15); padding: 2px 6px; border-radius: 3px;">0.25 (1/4)</span>, <span style="background: rgba(0, 212, 255, 0.15); padding: 2px 6px; border-radius: 3px;">0.5 (1/2)</span>, <span style="background: rgba(0, 212, 255, 0.15); padding: 2px 6px; border-radius: 3px;">0.75 (3/4)</span>, <span style="background: rgba(0, 212, 255, 0.15); padding: 2px 6px; border-radius: 3px;">1</span>
                </p>

                <!-- Draw Results Table -->
                <div style="margin-bottom: 40px;">
                    <h4 style="margin-bottom: 16px; color: #00d4ff; font-weight: 700;">⚽ Tỉ Số HOÀ (Draw)</h4>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <thead>
                                <tr style="background: rgba(76, 175, 80, 0.15); border-bottom: 2px solid rgba(76, 175, 80, 0.3);">
                                    <th style="padding: 12px; text-align: left; font-weight: 700; color: #81c784; border-right: 1px solid rgba(76, 175, 80, 0.2);">Tên</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 700; color: #81c784; border-right: 1px solid rgba(76, 175, 80, 0.2);">Đội</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #81c784; border-right: 1px solid rgba(76, 175, 80, 0.2);">0/0</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #81c784; border-right: 1px solid rgba(76, 175, 80, 0.2);">0/0.25</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #81c784; border-right: 1px solid rgba(76, 175, 80, 0.2);">0/0.5</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #81c784; border-right: 1px solid rgba(76, 175, 80, 0.2);">0/0.75</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #81c784;">0/1+</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid rgba(76, 175, 80, 0.1);">
                                    <td style="padding: 12px; border-right: 1px solid rgba(76, 175, 80, 0.1);">Team 1</td>
                                    <td style="padding: 12px; font-weight: 600; color: #00d4ff; border-right: 1px solid rgba(76, 175, 80, 0.1);">Kèo trên</td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);">0%</td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);"><span style="color: #ff6b6b;">↓ 50%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);"><span style="color: #ff6b6b;">↓ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);"><span style="color: #ff6b6b;">↓ 100%</span></td>
                                    <td style="padding: 12px; text-align: center;"><span style="color: #ff6b6b;">↓ 100%</span></td>
                                </tr>
                                <tr style="background: rgba(76, 175, 80, 0.05);">
                                    <td style="padding: 12px; border-right: 1px solid rgba(76, 175, 80, 0.1);">Team 2</td>
                                    <td style="padding: 12px; font-weight: 600; color: #ff8a80; border-right: 1px solid rgba(76, 175, 80, 0.1);">Kèo dưới</td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);">0%</td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);"><span style="color: #81c784;">↑ 50%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);"><span style="color: #81c784;">↑ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(76, 175, 80, 0.1);"><span style="color: #81c784;">↑ 100%</span></td>
                                    <td style="padding: 12px; text-align: center;"><span style="color: #81c784;">↑ 100%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Win by 1 Goal Table -->
                <div style="margin-bottom: 30px;">
                    <h4 style="margin-bottom: 16px; color: #00d4ff; font-weight: 700;">⚽ Tỉ Số THẮNG gác 1 bàn (Win by 1 Goal)</h4>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <thead>
                                <tr style="background: rgba(255, 193, 7, 0.15); border-bottom: 2px solid rgba(255, 193, 7, 0.3);">
                                    <th style="padding: 12px; text-align: left; font-weight: 700; color: #ffc107; border-right: 1px solid rgba(255, 193, 7, 0.2);">Tên</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 700; color: #ffc107; border-right: 1px solid rgba(255, 193, 7, 0.2);">Đội</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #ffc107; border-right: 1px solid rgba(255, 193, 7, 0.2);">1/0</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #ffc107; border-right: 1px solid rgba(255, 193, 7, 0.2);">1/0.25</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #ffc107; border-right: 1px solid rgba(255, 193, 7, 0.2);">1/0.5</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #ffc107; border-right: 1px solid rgba(255, 193, 7, 0.2);">1/0.75</th>
                                    <th style="padding: 12px; text-align: center; font-weight: 700; color: #ffc107;">1/1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid rgba(255, 193, 7, 0.1);">
                                    <td style="padding: 12px; border-right: 1px solid rgba(255, 193, 7, 0.1);">Team 1</td>
                                    <td style="padding: 12px; font-weight: 600; color: #00d4ff; border-right: 1px solid rgba(255, 193, 7, 0.1);">Kèo trên</td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #ff6b6b;">↓ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #ff6b6b;">↓ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #ff6b6b;">↓ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #ff6b6b;">↓ 50%</span></td>
                                    <td style="padding: 12px; text-align: center;">0%</td>
                                </tr>
                                <tr style="background: rgba(255, 193, 7, 0.05);">
                                    <td style="padding: 12px; border-right: 1px solid rgba(255, 193, 7, 0.1);">Team 2</td>
                                    <td style="padding: 12px; font-weight: 600; color: #ff8a80; border-right: 1px solid rgba(255, 193, 7, 0.1);">Kèo dưới</td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #81c784;">↑ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #81c784;">↑ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #81c784;">↑ 100%</span></td>
                                    <td style="padding: 12px; text-align: center; border-right: 1px solid rgba(255, 193, 7, 0.1);"><span style="color: #81c784;">↑ 50%</span></td>
                                    <td style="padding: 12px; text-align: center;">0%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Warning Note -->
                <div style="padding: 16px; background: rgba(244, 67, 54, 0.1); border-left: 4px solid #ff6b6b; border-radius: 8px;">
                    <p style="margin: 0; font-size: 0.9rem; color: #ff8a80;">
                        <i class="glyphicon glyphicon-exclamation-sign"></i> <b>⚠️ Lưu Ý:</b> Hướng dẫn chỉ mang tính tham khảo. Hãy đảm bảo nắm rõ luật chơi trước khi đặt cược!
                    </p>
                </div>
            </div>
        </div>

        <!-- Prize Structure Section -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-gift"></i>
                <h3>🎁 GIẢI THƯỞNG</h3>
            </div>
            <div class="rules-section-content">
                <div style="padding: 20px; background: rgba(255, 215, 0, 0.1); border-radius: 8px; margin-bottom: 30px; text-align: center;">
                    <p style="margin: 0; font-size: 1.2rem; font-weight: 700; color: #ffc107;">
                        Tổng giá trị giải thưởng: <span style="font-size: 1.4rem;">6,000,000₫</span>
                    </p>
                </div>

                <!-- Prize Tiers -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                    <!-- Diamond -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(220, 20, 60, 0.1) 0%, rgba(123, 47, 255, 0.1) 100%); border: 2px solid rgba(220, 20, 60, 0.3); border-radius: 12px;">
                        <div style="text-align: center;">
                            <p style="margin: 0 0 12px 0; font-size: 2rem;">💎</p>
                            <h4 style="margin: 0 0 12px 0; color: #ff6b9d; font-weight: 700;">DIAMOND</h4>
                            <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                <p style="margin: 6px 0; font-size: 0.9rem;">1 giải</p>
                                <p style="margin: 6px 0; font-size: 0.85rem; color: rgba(232, 234, 240, 0.7);">~25% tổng quỹ</p>
                                <p style="margin: 6px 0; font-weight: 700; color: #ff6b9d;">~1,500,000₫</p>
                            </div>
                        </div>
                    </div>

                    <!-- Platinum -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(192, 192, 192, 0.1) 0%, rgba(0, 212, 255, 0.1) 100%); border: 2px solid rgba(192, 192, 192, 0.3); border-radius: 12px;">
                        <div style="text-align: center;">
                            <p style="margin: 0 0 12px 0; font-size: 2rem;">🥈</p>
                            <h4 style="margin: 0 0 12px 0; color: #9db4c4; font-weight: 700;">PLATINUM</h4>
                            <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                <p style="margin: 6px 0; font-size: 0.9rem;">1 giải</p>
                                <p style="margin: 6px 0; font-size: 0.85rem; color: rgba(232, 234, 240, 0.7);">~20% tổng quỹ</p>
                                <p style="margin: 6px 0; font-weight: 700; color: #9db4c4;">~1,200,000₫</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gold -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 140, 0, 0.1) 100%); border: 2px solid rgba(255, 193, 7, 0.3); border-radius: 12px;">
                        <div style="text-align: center;">
                            <p style="margin: 0 0 12px 0; font-size: 2rem;">🥇</p>
                            <h4 style="margin: 0 0 12px 0; color: #ffc107; font-weight: 700;">GOLD</h4>
                            <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                <p style="margin: 6px 0; font-size: 0.9rem;">2 giải</p>
                                <p style="margin: 6px 0; font-size: 0.85rem; color: rgba(232, 234, 240, 0.7);">~10% tổng quỹ</p>
                                <p style="margin: 6px 0; font-weight: 700; color: #ffc107;">~600,000₫ / giải</p>
                            </div>
                        </div>
                    </div>

                    <!-- Silver -->
                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(169, 169, 169, 0.1) 0%, rgba(100, 149, 237, 0.1) 100%); border: 2px solid rgba(169, 169, 169, 0.3); border-radius: 12px;">
                        <div style="text-align: center;">
                            <p style="margin: 0 0 12px 0; font-size: 2rem;">🏅</p>
                            <h4 style="margin: 0 0 12px 0; color: #7c8fa3; font-weight: 700;">SILVER</h4>
                            <div style="background: rgba(255,255,255,0.05); padding: 12px; border-radius: 8px;">
                                <p style="margin: 6px 0; font-size: 0.9rem;">4 giải</p>
                                <p style="margin: 6px 0; font-size: 0.85rem; color: rgba(232, 234, 240, 0.7);">~5% tổng quỹ</p>
                                <p style="margin: 6px 0; font-weight: 700; color: #7c8fa3;">~300,000₫ / giải</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gift & Allocation Note -->
                <div style="padding: 20px; background: rgba(0, 212, 255, 0.1); border-left: 4px solid #00d4ff; border-radius: 8px; margin-bottom: 30px;">
                    <p style="margin: 0 0 12px 0; font-weight: 700;">🎀 Quà tặng: <span style="color: #00d4ff;">Móc Khoá</span></p>
                    <p style="margin: 0; font-size: 0.9rem; color: rgba(232, 234, 240, 0.8);">
                        * % = tỷ lệ trên tổng quỹ 6,000,000₫ (bao gồm 5% bổ sung, 10% phí bảo trì)
                    </p>
                </div>

                <!-- Program Rules -->
                <div style="padding: 20px; background: rgba(244, 67, 54, 0.1); border-left: 4px solid #ff6b6b; border-radius: 8px;">
                    <p style="margin: 0 0 16px 0; font-size: 1.05rem; font-weight: 700; color: #ff8a80;">
                        ⚖️ ĐIỀU LỆ CHƯƠNG TRÌNH
                    </p>
                    <ul style="margin: 0; padding-left: 20px; font-size: 0.95rem; line-height: 1.8;">
                        <li>Rules chi tiết được cập nhật liên tục trên <b>Wibet</b></li>
                        <li>Tôn trọng tinh thần chung: <b style="color: #ffd700;">"VUI LÀ CHÍNH"</b> 🎉</li>
                        <li>Gian lận hoặc lợi dụng lổ hổng → <b style="color: #ff6b6b;">KHOÁ ACCOUNT</b> ngay lập tức, <b>KHÔNG bồi thường</b></li>
                        <li style="color: rgba(232, 234, 240, 0.8);">(Team accounts: BTC thông báo cho Team Lead/PM)</li>
                        <li>Kết quả = tỉ số <b>02 Hiệp chính thức + bù giờ</b>. <b>KHÔNG tính</b> hiệp phụ, đá luân lưu, bốc thăm</li>
                        <li>Bet hợp lệ = được tính đến <b>05 PHÚT TRƯỚC</b> trọng tài thổi cò bắt đầu hiệp 01</li>
                        <li>Mâu thuẫn / tranh chấp → Liên hệ <b>BTC</b> ngay để được hỗ trợ</li>
                        <li style="background: rgba(255, 193, 7, 0.15); padding: 8px 12px; border-radius: 4px; margin-top: 8px;">
                            <b style="color: #ffc107;">⚠️ BTC sẽ đưa ra quyết định CUỐI CÙNG</b> trong mọi trường hợp!
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Closing Message -->
        <div class="rules-closing">
            <h5>❤️ LỜI THÌ THẦM MÙA BET ❤️</h5>

            <p style="margin-top: 20px; line-height: 1.8;">
                <b><?= $params['appName'] ?></b> là trang web <b>Cây Nhà Lá Vườn & Phi Lợi Nhuận</b>
            </p>

            <p style="line-height: 1.8;">
                Mục đích chính là tạo <b>sân chơi & gắn kết mọi người</b>, yêu thích bóng đá (<b style="color: #ff6b9d;">KHÔNG cờ bạc</b>)
            </p>

            <p style="line-height: 1.8;">
                Được xây dựng bởi <b>Wibet Dev Team</b> & quản lý bởi <b>Wibet Admin Team</b>
            </p>

            <p style="line-height: 1.8; margin-top: 20px;">
                Khi gặp khó khăn hoặc lỗi, <b><a target="_blank" href="<?= $params['groupChat'] ?>" style="color:#ffd700;">liên hệ với Chúng Tôi</a></b> để kịp thời khắc phục & cải tiến
            </p>

            <h3 style="margin-top: 40px; color: #ff6b9d;">Tập thể BTC Wibet</h3>
            <p style="font-size: 1rem; line-height: 1.8;">
                Chân thành cảm ơn sự ủng hộ, tin tưởng & gắn bó của toàn thể anh chị em! 🙏
            </p>

            <h4 style="color: #ffc107; margin-top: 40px; font-style: italic; line-height: 1.6;">
                CHÚC TOÀN THỂ ANH CHỊ EM CÓ MỘT SÂN CHƠI LÀNH MẠNH & VUI VẺ TRONG KÌ WC 2026
            </h4>

            <p style="margin-top: 30px; font-size: 0.95rem; letter-spacing: 1px;">
                <b>#WiBet #Since2015 #DC34Activity #DG6PUB #WorldCup2026</b>
            </p>

            <p style="margin-top: 30px; font-size: 1.05rem; color: #7fd9f0; line-height: 1.6;">
                <b>From Wibet to you with <span style="color: #ff6b9d;">❤️</span></b>
            </p>

            <div class="signature" style="margin-top: 40px;">
                <p style="margin: 10px 0 5px 0; font-size: 0.95rem;"><b>HCM, Wednesday 10th of June 2026</b></p>
                <p style="margin: 5px 0; font-size: 0.95rem;"><a href="mailto:<?= $params['adminEmail'] ?>" target="_blank" style="color:#ffd700;"><b>Wibet Admin</b></a></p>
            </div>
        </div>
    </div>
</div>
