<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */
$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-rules">
    <!-- <h1><?= Html::encode($this->title) ?></h1>-->
    <div id="rules-content">
        <center>
            <h1><b>THỂ LỆ THAM GIA CHƯƠNG TRÌNH</b></h1>
        </center>
        <hr>
        <section class="col-md-12">
        <h3><b>THỂ THỨC CHUNG</b></h3>
        <ul>
            <li>
                <p>Mỗi cá nhân và tập thể tạo Account bằng cách nạp vào cho ban tổ chức <b><?= Yii::$app->params['startingMoney'] ?>K VND (<?= Yii::$app->params['startingMoney'] ?> điểm)</b></p>
            </li>
            <li>
                <p>Account ngay lập tức được <span class="badge badge-pill badge-success">Active</span> với <b><?= Yii::$app->params['startingMoney'] ?> điểm</b>.</p>
            </li>
            <li>
                <p>Chương trình <b>Open <?= Yii::$app->params['appName'] ?></b> sẽ được chia làm 2 vòng đấu. <b><em>Giải thưởng sẽ
                            được tổng kết và trao sau mỗi vòng</em></b>.</p>
                <ul>
                    <li>
                        <p>Vòng đấu bảng (Từ trận đầu tiên đến vòng đầu cuối cùng của vòng bảng <?= Yii::$app->params['seasonName'] ?>)</p>
                    </li>
                    <li>
                        <p>Vòng loại trực tiếp (Tất cả các trận đấu từ vòng đấu loại trực tiếp cho đến trận chung kết)</p>
                    </li>
                </ul>
            </li>
            <li>
                <p>Mỗi cá nhân/Tập thể tối đa được tạo <b>02 Accounts</b> và được nộp tiền lại (<?= Yii::$app->params['startingMoney'] ?>K) sau khi số điểm dưới <b>50 điểm</b> (01 account được phép <b>nạp lại 03 lần cho vòng bảng</b> và
                    <b>02 lần cho vòng đấu loại trực tiếp</b>).
                </p>
                <ul>
                    <li>
                        <p>Mỗi tài khoản phải tham gia đặt <b>ít nhất 04 trận</b>, với số điểm tối thiểu đặt trong mỗi trận phải <b>từ 50 điểm trở lên</b>.</p>
                    </li>
                    <li>
                        <p>Các bạn dùng <b>Email TMA</b> để đăng ký nhưng không giới hạn cách đặt tên
                        </br>Ví dụ:</br>
                            <b> - Account:</b> ncqphong - ncqphong@tma.com.vn</br>
                            <b> - NickName:</b> Kuli Chúa
                        </p>
                    </li>
                    <li>
                        <p>Trong trường hợp có 02 hoặc nhiều người bằng điểm nhau thì người nào có số lần đặt cược nhiều hơn sẽ thắng, nếu mọi thứ như nhau thì chia đều giải thưởng</p>
                    </li>
                </ul>
            </li>
            <li>
                <p>Khuyến khích các quỹ tập thể tham gia và được đứng tên với tên Team tương ứng.</p>
            </li>
        </ul>
        <hr class="sl">
        </section>
        <section class="col-md-12">
        <h3><b>LIÊN HỆ & THANH TOÁN</b></h3>
        <p>Liên hệ <a href="skype:linhth_th1?chat"><b>SKYPE: TRƯƠNG HOÀNG LĨNH</b></a> đóng tiền và tạo Account.</p>
        <ul class="col-md-6">
            <li>
                <p>Có thể đóng tiền mặt hoặc chuyển khoản:</p>
				<table class="table table-hover">
                <tbody>
                    <tr>
                        <th scope="row">Tên: </th>
                        <td>TRUONG HOANG LINH</td>
                    </tr><tr>
                        <th scope="row">STK: </th>
                        <td>14410000066879</td>
                    </tr><tr></tr>
                        <th scope="row">Ngân hàng: </th>
                        <td>BIDV Thống Nhất TpHCM</td>
                    </tr><tr></tr>
                        <th scope="row">Nội dung: </th>
                        <td>Account_Tên Họ_wibet</td>
                    </tr><tr></tr>
                        <th scope="row"></th>
                        <td style="font-size:12px;">&nbsp&nbsp&nbsp(VD: thlinh_Lĩnh Trương_wibet)</td>
                    </tr>
                </tbody>
                </table>
            </li>
        </ul>
        <ul class="col-md-6">
            <li>
                <p>Hoặc chuyển tiền qua:</p>
				<table class="table table-hover">
                <tbody>
                    <tr>
                        <th scope="row">MoMo: </th>
                        <td>0939821124</td>
                    </tr><tr>
                        <th scope="row">Tên: </th>
                        <td>Trương Hoàng Lĩnh</td>
                    </tr><tr></tr>
                        <th scope="row">Nội dung: </th>
                        <td>Account_Tên Họ_wibet</td>
                    </tr><tr></tr>
                        <th scope="row"></th>
                        <td style="font-size:12px;">&nbsp&nbsp&nbsp(VD: thlinh_Lĩnh Trương_wibet)</td>
					</tr><tr></tr>
                        <th scope="row">Skype: </th>
                        <td><a href="skype:linhth_th1?chat">linhth_th1</a></td>
                    </tr>
                </tbody>
                </table>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-warning notice">
                <span><b>**NOTE**</b> ĐỂ ĐẢM BẢO TÍNH XÁC THỰC <b>**NOTE**</b></span></br>
                <span> - Sau khi xác thực đã nhận được tiền</span></br>
                <span> - Anh Lĩnh sẽ tiến hành tạo account và liên hệ lại để gửi <b>username/password</b></span></br>
                <span> - Khi nhận được <b>username/password</b>, bạn hãy tiến hành <a
                        href="/user/default/account"><b><em>đổi password</em></b></a></span>
                </div>
            </div>
        </div>
        </section>
        <hr class="sl">
        <section class="col-md-12">
        <h3><b>GIẢI THƯỞNG & ĐIỀU LỆ</b></h3>
        <ul>
            <li>
                <h4>CƠ CẤU GIẢI THƯỞNG</h4>
                <p>Cơ cấu giải thưởng bao gồm:</p>
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Giải</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá Trị</th>
                    <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                    <tbody>
                    <tr class="bg-success">
                        <th scope="row">1</th>
                        <td>DIAMON</td>
                        <td>01</td>
                        <td>~35%</td>
                        <td>0</td>
                    </tr><tr class="bg-primary">
                        <th scope="row">2</th>
                        <td>PLATINUM</td>
                        <td>01</td>
                        <td>~25%</td>
                        <td>0</td>
                    </tr><tr class="bg-warning">
                        <th scope="row">3</th>
                        <td>GOLD</td>
                        <td>01</td>
                        <td>~15%</td>
                        <td>0</td>
                    </tr><tr class="bg-info">
                        <th scope="row">4</th>
                        <td>SILVER</td>
                        <td>03</td>
                        <td>~05%</td>
                        <td>0</td>
					</tr>
                </tbody>
                </table>
                <p style="font-size:12px;">(*Phần trăm trên tổng giá trị quỹ thưởng : VND)</p>
            </li>
            <li>
                <h4>ĐIỀU LỆ THAM GIA</h4>
                <p>Rules chi tiết sẽ được update trực tiếp và liên tục lên web site <a href="/site/rules"><b><?= Yii::$app->params['appName'] ?></b></a></p>
                <ul>
                <li>
                    <p>Tôn trọng tinh thần chung của trò chơi <b style="color:red">"VUI LÀ CHÍNH, FAIR PLAY LÀ 10"</b>, Các hành vi gian lận trong trò chơi sẽ bị xem sét sử phạt </p>
                    <p>hoặc <b>khoá vĩnh viễn</b> tài khoản sai phạm mà không được bồi thường.</p>
                </li>
                <li>
                    <p>Bet hợp lệ là bet được tính đến <b>TRƯỚC LÚC TRỌNG TÀI THỔI CÒI BẮT ĐẦU TRẬN ĐẤU</b> (thời gian bắt đầu hiệp 01 của trận đấu đó)</p>
                </li>
                <li>
                    <p>Trong trường hợp sảy ra mâu thuẫn, tranh chấp, kiện cáo, BTC sẽ xem sét phương án hoà giải và khắc phục hợp lý nhất.</p>
                </li>
            </li>
        </ul>
        <div class="alert alert-danger" role="alert"><b>BTC sẽ là người đưa ra quyết định cuối cùng trong mọi trường hợp !</b></div>
    </div>
    </BR></BR>
    <hr class="sl col-md-12">
    </section>
    <section class="col-md-12">
    <center>
        <!-- <h4>CHÚC TOÀN THỂ ANH CHỊ EM CÓ MỘT SÂN CHƠI AN TOÀN VÀ VUI VẺ TRONG NHỮNG NGÀY WFH NÀY</h4>
        <h5>CÙNG CHUNG TAY ĐẨY LÙI ĐẠI DỊCH - THÂN ÁI VÀ QUYẾT THẮNG</h5> -->
        <h5 style="color:blue;">
            <p><b><em>#DC22WiBet</em></b></p>
        </h5>
    </center>
    <br>
    <p>
        <div style="float:right;text-align:center;"><b><em><span>HCM, <?= date('l jS \of F Y') ?></span></em></b><br>
        <span><h4><b>BTC & <a href="mailto:<?= Yii::$app->params['adminEmail'] ?>" target="_blank"><?= Yii::$app->params['senderName'] ?></a></b></h4>
        </span></div>
    </p>
    <br>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <br>
    </section>
</div>