<?php
use yii\helpers\Html;
use app\assets\Helper;

$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;

$params = Yii::$app->params;
$total = $params['totalAmount'];
$p1 = Helper::calculatePrices($total, $params['p1Rate'], $params['p1Count']);
$p2 = Helper::calculatePrices($total, $params['p2Rate'], $params['p2Count']);
$p3 = Helper::calculatePrices($total, $params['p3Rate'], $params['p3Count']);
$p4 = Helper::calculatePrices($total, $params['p4Rate'], $params['p4Count']);
$p5 = Helper::calculatePrices($total, $params['p5Rate'], $params['p5Count']);
?>

<style>
/* Dark Dramatic Theme */
.site-rules {
    background: linear-gradient(180deg, #0a0e1a 0%, #0f1422 100%);
    color: #e8eaf0;
    padding-bottom: 60px;
}

.rules-hero {
    background: linear-gradient(135deg, rgba(123, 47, 255, 0.15) 0%, rgba(0, 212, 255, 0.15) 100%);
    border-top: 3px solid #00d4ff;
    border-bottom: 3px solid #7b2fff;
    padding: 60px 20px;
    margin-bottom: 50px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.rules-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 50% 50%, rgba(0,212,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}

.rules-hero h1 {
    font-family: 'BebasNeueRegular', Arial, sans-serif;
    font-size: 48px;
    font-weight: 900;
    color: #ffffff;
    text-shadow: 0 0 20px rgba(0, 212, 255, 0.8), 0 0 40px rgba(123, 47, 255, 0.6);
    margin: 0;
    letter-spacing: 3px;
    position: relative;
    z-index: 1;
}

.rules-hero p {
    color: #b8bcc8;
    font-size: 16px;
    margin-top: 10px;
    position: relative;
    z-index: 1;
}

.rules-section {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 12px;
    margin-bottom: 40px;
    backdrop-filter: blur(10px);
    overflow: hidden;
    transition: all 0.3s ease;
}

.rules-section:hover {
    border-color: rgba(0, 212, 255, 0.4);
    box-shadow: 0 0 30px rgba(0, 212, 255, 0.15);
}

.rules-section-header {
    background: linear-gradient(90deg, rgba(0, 212, 255, 0.1) 0%, transparent 100%);
    border-left: 4px solid #00d4ff;
    padding: 20px 25px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.rules-section-header i {
    font-size: 28px;
    color: #00d4ff;
    text-shadow: 0 0 10px rgba(0, 212, 255, 0.6);
}

.rules-section-header h3 {
    margin: 0;
    font-family: 'Dosis', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    letter-spacing: 1px;
}

.rules-section-content {
    padding: 30px;
}

.rules-section-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.rules-section-content > ul > li {
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

.rules-section-content > ul > li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.rules-section-content p {
    margin: 0 0 12px 0;
    line-height: 1.6;
    color: #d4d8e0;
}

.rules-section-content strong {
    color: #00d4ff;
}

.rules-section-content ul ul {
    margin-top: 15px;
    margin-left: 20px;
    padding-left: 0;
}

.rules-section-content ul ul li {
    list-style: none;
    margin-bottom: 12px;
    padding-left: 25px;
    position: relative;
}

.rules-section-content ul ul li:before {
    content: '▸';
    position: absolute;
    left: 0;
    color: #7b2fff;
    font-weight: bold;
}

.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    margin: 2px;
    white-space: nowrap;
}

.badge-pill {
    border-radius: 20px;
}

.badge-primary {
    background: rgba(123, 47, 255, 0.3);
    color: #b8a3ff;
}

.badge-success {
    background: rgba(76, 175, 80, 0.3);
    color: #a8d5a8;
}

.badge-info {
    background: rgba(0, 212, 255, 0.3);
    color: #7fd9f0;
}

.badge-warning {
    background: rgba(255, 193, 7, 0.3);
    color: #ffd700;
}

.badge-danger {
    background: rgba(244, 67, 54, 0.3);
    color: #ff9a9a;
}

/* Prize Tier Cards */
.prize-tiers-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.prize-tier-card {
    border-radius: 12px;
    padding: 30px 20px;
    text-align: center;
    border: 2px solid;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.prize-tier-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
}

.prize-tier-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 212, 255, 0.2);
}

.prize-tier-card.diamond {
    background: linear-gradient(135deg, rgba(220, 20, 60, 0.15) 0%, rgba(123, 47, 255, 0.15) 100%);
    border-color: rgba(220, 20, 60, 0.5);
}

.prize-tier-card.platinum {
    background: linear-gradient(135deg, rgba(192, 192, 192, 0.15) 0%, rgba(0, 212, 255, 0.15) 100%);
    border-color: rgba(192, 192, 192, 0.5);
}

.prize-tier-card.gold {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15) 0%, rgba(255, 140, 0, 0.15) 100%);
    border-color: rgba(255, 193, 7, 0.5);
}

.prize-tier-card.silver {
    background: linear-gradient(135deg, rgba(169, 169, 169, 0.15) 0%, rgba(100, 149, 237, 0.15) 100%);
    border-color: rgba(169, 169, 169, 0.5);
}

.prize-tier-name {
    font-family: 'BebasNeueRegular', Arial, sans-serif;
    font-size: 28px;
    font-weight: 900;
    letter-spacing: 2px;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
}

.prize-tier-card.diamond .prize-tier-name { color: #ff6b9d; }
.prize-tier-card.platinum .prize-tier-name { color: #c0c0c0; }
.prize-tier-card.gold .prize-tier-name { color: #ffd700; }
.prize-tier-card.silver .prize-tier-name { color: #b0c4de; }

.prize-tier-count,
.prize-tier-rate,
.prize-tier-value {
    font-size: 13px;
    margin: 8px 0;
    color: #b8bcc8;
    position: relative;
    z-index: 1;
}

.prize-tier-gift {
    margin-top: 20px;
    position: relative;
    z-index: 1;
}

.prize-tier-gift img {
    max-width: 80px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.1);
}

/* Tables */
.rules-table {
    width: 100%;
    background: rgba(255, 255, 255, 0.02);
    border-collapse: collapse;
    margin-top: 20px;
    border-radius: 8px;
    overflow: hidden;
}

.rules-table thead {
    background: rgba(0, 212, 255, 0.1);
    border-bottom: 2px solid rgba(0, 212, 255, 0.3);
}

.rules-table th {
    padding: 15px;
    text-align: left;
    color: #00d4ff;
    font-weight: 600;
    font-family: 'Dosis', sans-serif;
}

.rules-table td {
    padding: 12px 15px;
    border-bottom: 1px solid rgba(0, 212, 255, 0.1);
}

.rules-table tbody tr:hover {
    background: rgba(0, 212, 255, 0.05);
}

.rules-table tbody tr:last-child td {
    border-bottom: none;
}

/* Two Column Layout */
.two-column-layout {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 25px;
}

.payment-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(0, 212, 255, 0.2);
    border-radius: 10px;
    padding: 25px;
    backdrop-filter: blur(5px);
}

.payment-card h4 {
    color: #00d4ff;
    margin-top: 0;
    font-family: 'Dosis', sans-serif;
}

.payment-card .qr-code {
    max-width: 150px;
    border-radius: 8px;
    border: 2px solid rgba(0, 212, 255, 0.2);
    margin-top: 15px;
}

/* Alert Boxes */
.rules-alert {
    background: rgba(255, 193, 7, 0.1);
    border-left: 4px solid #ffc107;
    border-radius: 8px;
    padding: 20px 25px;
    margin: 20px 0;
    color: #fdd06a;
}

.rules-alert strong {
    color: #ffd700;
}

.rules-alert-danger {
    background: rgba(244, 67, 54, 0.1);
    border-left-color: #f44336;
    color: #ff9a9a;
}

.rules-alert-danger strong {
    color: #ff6b6b;
}

/* Closing Section */
.rules-closing {
    background: linear-gradient(135deg, rgba(255, 140, 0, 0.15) 0%, rgba(220, 20, 60, 0.15) 100%);
    border: 2px solid rgba(255, 140, 0, 0.3);
    border-radius: 12px;
    padding: 50px 30px;
    text-align: center;
    margin-top: 50px;
    position: relative;
}

.rules-closing h5 {
    color: #ffd700;
    font-size: 18px;
    margin: 20px 0;
}

.rules-closing h3 {
    color: #ffffff;
    font-family: 'BebasNeueRegular', Arial, sans-serif;
    font-size: 24px;
    letter-spacing: 1px;
}

.rules-closing p {
    color: #d4d8e0;
    line-height: 1.8;
    font-size: 15px;
}

.rules-closing .signature {
    margin-top: 40px;
    border-top: 2px solid rgba(255, 140, 0, 0.3);
    padding-top: 20px;
    color: #b8bcc8;
}

.rules-closing .signature strong {
    color: #ffd700;
}

/* Responsive */
@media (max-width: 768px) {
    .rules-hero h1 {
        font-size: 36px;
    }

    .rules-section-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .prize-tiers-container {
        grid-template-columns: 1fr;
    }

    .two-column-layout {
        grid-template-columns: 1fr;
    }

    .rules-section-content {
        padding: 20px;
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
