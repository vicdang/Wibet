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
</style>

<div class="site-rules">
    <!-- Hero Banner -->
    <div class="rules-hero">
        <h1>🎯 THỂ LỆ THAM GIA</h1>
        <p><?= $params['appName'] ?> • <?= $params['seasonName'] ?></p>
    </div>

    <!-- General Rules -->
    <div class="container">
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-globe"></i>
                <h3>THỂ THỨC CHUNG</h3>
            </div>
            <div class="rules-section-content">
                <ul>
                    <li>
                        <p>Chương trình <b><?= $params['appName'] ?>-<?= $params['seasonName'] ?></b> được chia làm <b>02 vòng đấu</b>. <b><em>Giải thưởng tổng kết và trao sau mỗi vòng</em></b>.</p>
                        <ul>
                            <li>
                                <p><span class="badge badge-primary"><i class="glyphicon glyphicon-ok"></i> <?=$params['roundStatus'][0]?></span><b> Vòng Bảng (VB)</b>: Từ trận đầu tiên đến vòng đầu cuối cùng của vòng bảng</p>
                            </li>
                            <li>
                                <p><span class="badge badge-success"><i class="glyphicon glyphicon-flag"></i> <?=$params['roundStatus'][1]?></span><b> Vòng Loại Trực Tiếp (LTT)</b>: Tất cả các trận đấu từ vòng đấu loại trực tiếp cho đến trận chung kết</p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>Mỗi Cá nhân/Tập thể tạo <b>tối đa 02 Accounts</b> bằng cách liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>" style="color:#00d4ff;">Admin <?= $params['adminName'] ?></a></b> để nạp tiền</p>
                        <ul>
                            <li>
                                <p>Chỉ với <span class="badge badge-info"><?= $params['minPayMoney'] ?>.000 VND</span> Account được <span class="badge badge-success">Activated</span> với <b><span class="badge badge-warning"><?= $params['minPayMoney'] ?><?= $params['currency'] ?></span> khởi đầu</b></p>
                            </li>
                            <li>
                                <p>Mỗi vòng đấu, một account nạp thêm:</p>
                                <p>- <b>Cố định:</b> <span class="badge badge-warning"><?= $params['minPayMoney'] ?><?= $params['currency'] ?></span> mỗi lần nạp</p>
                                <p>- <span class="badge badge-success">Hồi sinh</span> duy nhất <b>1 lần</b>, <span class="badge badge-primary">Cấp Cứu</span> tối đa <b><?= $params['maxRefillTimes']-1?> lần</b></p>
                                <p style="font-size:13px; color:#b8bcc8;"><b>(Không nạp quá <?= $params['maxRefillTimes']?> lần = <?= $params['maxRefillTimes']*$params['minPayMoney'] ?><?= $params['currency'] ?>)</b></p>
                                <p>- <b>Chú ý:</b> <span class="badge badge-primary">Cấp Cứu</span> khi tổng điểm &lt; <span class="badge badge-warning"><?= $params['minBetMoney']*2 ?><?= $params['currency']?></span></p>
                            </li>
                            <li>
                                <p>Quy đổi: <span class="badge badge-success">1.000 VND</span> = <span class="badge badge-warning">1<?= $params['currency'] ?></span></p>
                                <p style="font-size:13px; color:#b8bcc8;"><b>(<?= $params['currencyName'] ?> là đơn vị đo lường, KHÔNG quy đổi tiền mặt)</b></p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>Cổng thanh toán mở <span class="badge badge-info"><?= $params['payTime'][0]?></span> - <span class="badge badge-warning"><?= $params['payTime'][1]?></span> hàng ngày</p>
                    </li>
                    <li>
                        <p>Giao dịch sau <span class="badge badge-danger"><?= $params['payTime'][1]?></span> xử lý vào <span class="badge badge-info"><?= $params['payTime'][0]?></span> ngày hôm sau</p>
                    </li>
                    <li>
                        <p>Cổng ngưng toàn bộ giao dịch <span class="badge badge-danger"><?= $params['payTime'][1]?></span> trước <b>03 ngày</b> kết thúc vòng cuối</p>
                        <p style="font-size:13px; color:#b8bcc8;"><b>(Đảm bảo quyền lợi cho những account tham gia từ đầu)</b></p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Participation Rules -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-list-alt"></i>
                <h3>QUY TẮC THAM GIA</h3>
            </div>
            <div class="rules-section-content">
                <ul>
                    <li><p>Tối đa <span class="badge badge-info"><?= $params['accountPerUser'] ?> Accounts</span> / người</p></li>
                    <li><p>Nạp tiền <b>BẤT CỨ KHI NÀO</b> bạn muốn</p></li>
                    <li><p><b>Tip:</b> Nhớ chú ý khung giờ mở cổng nạp & số lượng refill còn lại để có chiến thuật tốt nhất!</p></li>
                    <li>
                        <p>Mỗi account tham gia <b>tối thiểu <span class="badge badge-info"><?= $params['minBetTimes'] ?> trận</span></b>, mỗi trận tối thiểu <span class="badge badge-warning"><?= $params['minBetMoney'] ?><?= $params['currency'] ?></span></p>
                        <p style="font-size:13px; color:#b8bcc8;"><b>(Có thể đặt lẻ, vd: <?=$params['minBetMoney']+1?><?=$params['currency']?>)</b></p>
                    </li>
                    <li>
                        <p>Email TMA không giới hạn tên người chơi:</p>
                        <p style="color:#7fd9f0;"><b>Tên:</b> Man Văn Bét • <b>Account:</b> mvbet • <b>NickName:</b> Bét Man</p>
                        <p style="font-size:13px;">Nếu đã tạo ở vòng Bảng, tái sử dụng để được ưu đãi TRI ÂN BET THỦ</p>
                    </li>
                    <li>
                        <p>Nếu <b>2+ người bằng điểm</b> → áp dụng <b>Luật ưu tiên</b>:</p>
                        <p style="color:#ffd700;"><b>Tổng điểm (Total) > Số lần cược (Bet) > Số lần thắng (Win)</b></p>
                    </li>
                    <li><p>Khuyến khích các quỹ tập thể tham gia với tên Team tương ứng</p></li>
                </ul>
            </div>
        </div>

        <!-- Payment & Contact -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-credit-card"></i>
                <h3>LIÊN HỆ & THANH TOÁN</h3>
            </div>
            <div class="rules-section-content">
                <p>Liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>" style="color:#00d4ff;">Admin <?= $params['adminName'] ?></a></b> để nạp tiền và tạo Account.</p>

                <div class="two-column-layout">
                    <div class="payment-card">
                        <h4>🏦 Chuyển khoản Ngân hàng</h4>
                        <table class="rules-table">
                            <tr><th>Tên</th><td><?= $params['bankName'] ?></td></tr>
                            <tr><th>STK</th><td><?= $params['bankID'] ?></td></tr>
                            <tr><th>Ngân hàng</th><td><?= $params['bankBrand'] ?></td></tr>
                            <tr><th>Nội dung</th><td>[TMA Account]_[nickname]_[Họ Tên]_wb</td></tr>
                            <tr><th></th><td style="font-size:12px; color:#7fd9f0;">mvbet_Betman_Bét Man_wb</td></tr>
                        </table>
                        <div style="text-align:center;">
                            <a href="<?= $params['bankLink'] ?>"><img class="qr-code" src="../images/qr/bank-qr.png" alt="Bank QR"></a>
                        </div>
                    </div>

                    <div class="payment-card">
                        <h4>📱 Momo</h4>
                        <table class="rules-table">
                            <tr><th>Tên</th><td><?= $params['momoName'] ?></td></tr>
                            <tr><th>MoMo</th><td><?= $params['momoNumb'] ?></td></tr>
                            <tr><th>Skype</th><td><a href="<?= $params['adminChat'] ?>" style="color:#00d4ff;"><?= $params['adminName'] ?></a></td></tr>
                            <tr><th>Nội dung</th><td>[TMA Account]_[nickname]_[Họ Tên]_wb</td></tr>
                            <tr><th></th><td style="font-size:12px; color:#7fd9f0;">mvbet_Betman_Bét Man_wb</td></tr>
                        </table>
                        <div style="text-align:center;">
                            <a href=""><img class="qr-code" src="../images/qr/momo-qr.png" alt="Momo QR"></a>
                        </div>
                    </div>
                </div>

                <div class="rules-alert" style="margin-top: 30px;">
                    <p><strong><i class="glyphicon glyphicon-warning-sign"></i> ĐẢM BẢO XÁC THỰC</strong></p>
                    <p><b>1. Người chơi mới:</b></p>
                    <ul style="margin-left: 20px;">
                        <li>Liên hệ <a href="<?= $params['adminChat'] ?>" style="color:#00d4ff;"><b>Admin <?= $params['adminName'] ?></b></a> để nạp tiền & tạo account</li>
                        <li>Admin tạo account & gửi username/password</li>
                        <li>Đổi password tại <a href="/user/default/account" style="color:#00d4ff;"><b>Change Password</b></a> & <a href="/user/login" style="color:#00d4ff;"><b>Login</b></a></li>
                    </ul>
                    <p><b>2. Account cũ:</b></p>
                    <ul style="margin-left: 20px;">
                        <li>Nạp tiền → account sẽ được hồi sinh</li>
                        <li>Account mới sẽ <b style="color:#ff9a9a;">KHÔNG</b> được ưu đãi TRI ÂN BET THỦ</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Loyalty Program -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-heart"></i>
                <h3>TRI ÂN BET THỦ</h3>
            </div>
            <div class="rules-section-content">
                <p>Nhằm tri ân những Accounts tham gia Vòng Bảng (VB), mỗi account cũ tạo ở Vòng Loại Trực Tiếp (LTT) được ưu đãi:</p>
                <ul>
                    <li>
                        <p>Nạp đạt <span class="badge badge-warning">400<?= $params['currency'] ?></span> → Tặng thêm <span class="badge badge-info">20%</span> lần nạp đầu tiên <span class="badge badge-warning">(+60<?=$params['currency']?> = 360<?=$params['currency']?>)</span></p>
                    </li>
                    <li>
                        <p>Nạp đạt <span class="badge badge-warning">600<?= $params['currency'] ?></span> → Tặng thêm <span class="badge badge-info">30%</span> lần nạp đầu tiên <span class="badge badge-warning">(+90<?=$params['currency']?> = 390<?=$params['currency']?>)</span></p>
                    </li>
                    <li>
                        <p>Nạp đạt <span class="badge badge-warning">800<?= $params['currency'] ?></span> → Tặng thêm <span class="badge badge-info">50%</span> lần nạp đầu tiên <span class="badge badge-warning">(+150<?=$params['currency']?> = 450<?=$params['currency']?>)</span></p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Access Levels -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-eye-open"></i>
                <h3>MỨC ĐỘ TRUY CẬP MỖI VÒNG</h3>
            </div>
            <div class="rules-section-content">
                <table class="rules-table">
                    <thead>
                        <tr>
                            <th>Mục</th>
                            <th>Chi tiết</th>
                            <th>VB</th>
                            <th>LTT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Ranking</b></td>
                            <td>Xem lịch sử cược của người khác</td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                            <td><span class="badge badge-danger">✗ Không</span></td>
                        </tr>
                        <tr>
                            <td><b>Ranking</b></td>
                            <td>Xem info cơ bản (điểm hiện tại & đã cược)</td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                        </tr>
                        <tr>
                            <td><b>Matches</b></td>
                            <td>Xem tỉ lệ cược & tỉ lệ chọi</td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                        </tr>
                        <tr>
                            <td><b>Matches</b></td>
                            <td>Xem danh sách người chơi tham gia</td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                            <td><span class="badge badge-danger">✗ Không</span></td>
                        </tr>
                        <tr>
                            <td><b>Matches</b></td>
                            <td>Xem & chỉnh sửa cược bản thân</td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                        </tr>
                        <tr>
                            <td><b>Matches</b></td>
                            <td>Xem chi tiết cược trận đang đấu</td>
                            <td><span class="badge badge-success">✓ Có</span></td>
                            <td><span class="badge badge-danger">✗ Không</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Beginner Guide -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-book"></i>
                <h3>HƯỚNG DẪN TÂN THỦ</h3>
            </div>
            <div class="rules-section-content">
                <p>Chương trình hổ trợ kèo: <b>0, 0.25 (1/4), 0.5 (1/2), 0.75 (3/4), 1</b></p>

                <h4 style="color:#00d4ff; margin-top:30px;">Tỉ số HOÀ (Draw)</h4>
                <table class="rules-table">
                    <thead>
                        <tr>
                            <th>Tên</th><th>Đội</th><th>0/0</th><th>0/0.25</th><th>0/0.5</th><th>0/0.75</th><th>0/1+</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: rgba(123, 47, 255, 0.1);">
                            <td><b>Team 1</b></td><td>Kèo trên</td>
                            <td><span class="badge badge-warning">0%</span></td>
                            <td><span class="badge badge-danger">↓ 50%</span></td>
                            <td><span class="badge badge-danger">↓ 100%</span></td>
                            <td><span class="badge badge-danger">↓ 100%</span></td>
                            <td><span class="badge badge-danger">↓ 100%</span></td>
                        </tr>
                        <tr style="background: rgba(76, 175, 80, 0.1);">
                            <td><b>Team 2</b></td><td>Kèo dưới</td>
                            <td><span class="badge badge-warning">0%</span></td>
                            <td><span class="badge badge-success">↑ 50%</span></td>
                            <td><span class="badge badge-success">↑ 100%</span></td>
                            <td><span class="badge badge-success">↑ 100%</span></td>
                            <td><span class="badge badge-success">↑ 100%</span></td>
                        </tr>
                    </tbody>
                </table>

                <h4 style="color:#00d4ff; margin-top:30px;">Tỉ số THẮNG (Win) gác 1 bàn</h4>
                <table class="rules-table">
                    <thead>
                        <tr>
                            <th>Tên</th><th>Đội</th><th>1/0</th><th>1/0.25</th><th>1/0.5</th><th>1/0.75</th><th>1/1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background: rgba(123, 47, 255, 0.1);">
                            <td><b>Team 1</b></td><td>Kèo trên</td>
                            <td><span class="badge badge-danger">↓ 100%</span></td>
                            <td><span class="badge badge-danger">↓ 100%</span></td>
                            <td><span class="badge badge-danger">↓ 100%</span></td>
                            <td><span class="badge badge-danger">↓ 50%</span></td>
                            <td><span class="badge badge-warning">0%</span></td>
                        </tr>
                        <tr style="background: rgba(76, 175, 80, 0.1);">
                            <td><b>Team 2</b></td><td>Kèo dưới</td>
                            <td><span class="badge badge-success">↑ 100%</span></td>
                            <td><span class="badge badge-success">↑ 100%</span></td>
                            <td><span class="badge badge-success">↑ 100%</span></td>
                            <td><span class="badge badge-success">↑ 50%</span></td>
                            <td><span class="badge badge-warning">0%</span></td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size:13px; color:#b8bcc8; margin-top:15px;"><b>⚠️ Hướng dẫn chỉ mang tính tham khảo. Hãy đảm bảo nắm rõ luật chơi trước khi đặt cược!</b></p>
            </div>
        </div>

        <!-- Prizes -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-star"></i>
                <h3>GIẢI THƯỞNG</h3>
            </div>
            <div class="rules-section-content">
                <p>Tổng giá trị giải thưởng: <span class="badge badge-warning"><b><?=number_format($params['totalAmount'],0)?><?=$params['currencyReal']?></b></span></p>

                <div class="prize-tiers-container">
                    <div class="prize-tier-card diamond">
                        <div class="prize-tier-name">💎 DIAMOND</div>
                        <div class="prize-tier-count"><b><?= $params['p1Count'] ?></b> giải</div>
                        <div class="prize-tier-rate">~<?= $params['p1Rate'] ?>% tổng quỹ</div>
                        <div class="prize-tier-value">~<?= $p1['price'] ?><?= $params['currencyReal']?> / giải</div>
                        <div class="prize-tier-gift">
                            <img class="gift sm" src="../images/gift/gift_1.jpg" alt="Prize">
                        </div>
                    </div>

                    <div class="prize-tier-card platinum">
                        <div class="prize-tier-name">🥈 PLATINUM</div>
                        <div class="prize-tier-count"><b><?= $params['p2Count'] ?></b> giải</div>
                        <div class="prize-tier-rate">~<?= $params['p2Rate'] ?>% tổng quỹ</div>
                        <div class="prize-tier-value">~<?= $p2['price'] ?><?= $params['currencyReal']?> / giải</div>
                        <div class="prize-tier-gift">
                            <img class="gift sm" src="../images/gift/gift_1.jpg" alt="Prize">
                        </div>
                    </div>

                    <div class="prize-tier-card gold">
                        <div class="prize-tier-name">🥇 GOLD</div>
                        <div class="prize-tier-count"><b><?= $params['p3Count'] ?></b> giải</div>
                        <div class="prize-tier-rate">~<?= $params['p3Rate'] ?>% tổng quỹ</div>
                        <div class="prize-tier-value">~<?= $p3['price'] ?><?= $params['currencyReal']?> / giải</div>
                        <div class="prize-tier-gift">
                            <img class="gift sm" src="../images/gift/gift_1.jpg" alt="Prize">
                        </div>
                    </div>

                    <div class="prize-tier-card silver">
                        <div class="prize-tier-name">🏅 SILVER</div>
                        <div class="prize-tier-count"><b><?= $params['p4Count'] ?></b> giải</div>
                        <div class="prize-tier-rate">~<?= $params['p4Rate'] ?>% tổng quỹ</div>
                        <div class="prize-tier-value">~<?= $p4['price'] ?><?= $params['currencyReal']?> / giải</div>
                        <div class="prize-tier-gift">
                            <img class="gift sm" src="../images/gift/gift_1.jpg" alt="Prize">
                        </div>
                    </div>
                </div>

                <p style="font-size:13px; color:#b8bcc8; margin-top:30px;"><b>*</b> % = tỷ lệ trên tổng quỹ <?=number_format($params['totalAmount'],0)?><?=$params['currencyReal']?> (bao gồm <?= $params['adjRate'] ?>% bổ sung, <?= $params['mtRate'] ?>% phí bảo trì)</p>
                <p style="text-align:center; color:#ffd700; margin-top:20px;"><b>Quà tặng: <?=$params['giftItem']?></b></p>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="rules-section">
            <div class="rules-section-header">
                <i class="glyphicon glyphicon-certificate"></i>
                <h3>ĐIỀU LỆ CHƯƠNG TRÌNH</h3>
            </div>
            <div class="rules-section-content">
                <p>Rules chi tiết được cập nhật liên tục trên <a href="/site/rules" style="color:#00d4ff;"><b><?= $params['appName'] ?></b></a></p>
                <ul>
                    <li>
                        <p>Tôn trọng tinh thần chung: <b style="color:#ffd700;">"VUI LÀ CHÍNH"</b> 🎉</p>
                    </li>
                    <li>
                        <p>Gian lận hoặc lợi dụng lổ hổng → <b style="color:#ff9a9a;">KHOÁ ACCOUNT</b> ngay lập tức, không bồi thường</p>
                        <p style="font-size:13px; color:#b8bcc8;"><b>(Team accounts: BTC thông báo cho Team Lead/PM)</b></p>
                    </li>
                    <li>
                        <p>Kết quả = tỉ số <b>02 Hiệp chính thức</b> + bù giờ. <b style="color:#ff9a9a;">KHÔNG</b> tính hiệp phụ, đá luân lưu, bốc thăm</p>
                    </li>
                    <li>
                        <p>Bet hợp lệ = được tính đến <b>05 PHÚT TRƯỚC</b> trọng tài thổi cò bắt đầu hiệp 01</p>
                    </li>
                    <li>
                        <p>Mâu thuẫn / tranh chấp → Liên hệ BTC ngay để được hỗ trợ</p>
                    </li>
                </ul>

                <div class="rules-alert-danger" style="margin-top: 25px;">
                    <p><b>⚠️ BTC sẽ đưa ra quyết định CUỐI CÙNG trong mọi trường hợp!</b></p>
                </div>
            </div>
        </div>

        <!-- Closing Message -->
        <div class="rules-closing">
            <h5>❤️ LỜI THÌ THẦM MÙA BET ❤️</h5>
            <p><b><?= $params['appName'] ?></b> là trang web <b>Cây Nhà Lá Vườn</b> & <b>Phi Lợi Nhuận</b></p>
            <p>Mục đích chính là <b>tạo sân chơi</b> & <b>gắn kết mọi người</b>, yêu thích bóng đá (KHÔNG cờ bạc)</p>

            <p style="margin-top:30px;">Được xây dựng bởi <b><?= $params['appName'] ?> Dev Team</b> & quản lý bởi <b><?= $params['appName'] ?> Admin Team</b></p>

            <p>Khi gặp khó khăn hoặc lỗi, <b><a target="_blank" href="<?= $params['groupChat'] ?>" style="color:#ffd700;">liên hệ với Chúng Tôi</a></b> để kịp thời khắc phục & cải tiến</p>

            <h3 style="margin-top:40px;">Tập thể <b>BTC <?= $params['appName'] ?></b></h3>
            <p>Chân thành cảm ơn sự ủng hộ, tin tưởng & gắn bó của toàn thể anh chị em! 🙏</p>

            <h4 style="color:#ffd700; margin-top:40px; font-style:italic;">CHÚC TOÀN THỂ ANH CHỊ EM CÓ MỘT SÂN CHƠI LÀNH MẠNH & VUI VẺ TRONG KÌ <?= $params['seasonName'] ?></h4>

            <p style="margin-top:30px; font-size:16px;"><b>#WiBet #Since2015 #DC34Activity #DG6PUB #WorldCup2026</b></p>

            <p style="margin-top:30px; font-size:15px; color:#7fd9f0;"><b>From <u><?= $params['appName'] ?></u> to you with <span style="color:#ff6b9d;">❤️</span></b></p>

            <div class="signature">
                <p style="margin: 20px 0 0 0;"><b>HCM, <?= date('l jS \of F Y') ?></b></p>
                <p style="margin: 10px 0;"><a href="mailto:<?= $params['adminEmail'] ?>" target="_blank" style="color:#ffd700;"><b><?= $params['senderName'] ?> Admin</b></a></p>
            </div>
        </div>
    </div>
</div>
