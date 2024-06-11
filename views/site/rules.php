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
        <h3 class="alert alert-dark"><b>THỂ THỨC CHUNG</b></h3>
        <ul>
            <li>
                <p>Mỗi cá nhân và tập thể tạo Account bằng cách liên hệ Ban Tổ Chức(BTC) để nạp vào <span class="badge badge-pill badge-warning"><b><?= Yii::$app->params['startingMoney'] ?>.000 VND</b></span> (tương ứng <b><?= Yii::$app->params['startingMoney'] ?> <?= Yii::$app->params['currencyName'] ?></b>)</p>
            </li>
            <li>
                <p>Account ngay lập tức được <span class="badge badge-pill badge-success">Activated</span> với <b><?= Yii::$app->params['startingMoney'] ?><?= Yii::$app->params['currency'] ?></b></p>
            </li>
            <li>
                <p>Chương trình <b><?= Yii::$app->params['appName'] ?></b> sẽ được chia làm 02 vòng đấu. <b><em>Giải thưởng sẽ
                            được tổng kết và trao sau mỗi vòng</em></b>.</p>
                <ul>
                    <li>
                        <p><b>Vòng Bảng</b>: Từ trận đầu tiên đến vòng đầu cuối cùng của vòng bảng <?= Yii::$app->params['seasonName'] ?></p>
                    </li>
                    <li>
                        <p><b>Vòng Loại Trực Tiếp</b>: Tất cả các trận đấu từ vòng đấu loại trực tiếp cho đến trận chung kết</p>
                    </li>
                </ul>
            </li>
        </ul>
            <!-- <li> -->
                <div class="col-lg-12">
                    <h4>Mức độ truy cập:</h4>
                    <div class="table-responsive">
                        <table class="table table-hover wrap-table">
                            <thead>
                                <tr>
                                    <th scope="col">Mục</th>
                                    <th scope="col">Chi tiết</th>
                                    <th scope="col">Vòng Bảng</th>
                                    <th scope="col">Vòng Loại Trực Tiếp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Ranking</th>
                                    <td>Xem lịch sử đặt cược của người chơi khác</td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                    <td><span class="badge badge-pill badge-danger">Không</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ranking</th>
                                    <td>Xem thông tin cơ bản về số điểm hiện có và số điểm đã cược</td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Matches</th>
                                    <td>Xem tỉ lệ đặt cược và tỉ lệ chọi</td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Matches</th>
                                    <td>Xem thông tin chi tiết về danh sách người chơi tham gia cược</td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                    <td><span class="badge badge-pill badge-danger">Không</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Matches</th>
                                    <td>Xem số điểm bản thân đã cược và chỉnh sửa</td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Matches</th>
                                    <td>Xem chi tiết cược của trận đang đấu</td>
                                    <td><span class="badge badge-pill badge-success">Có</span></td>
                                    <td><span class="badge badge-pill badge-danger">Không</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- </li> -->
        <ul>
            <li>
                <p>Nhằm tri ân những Accounts đã tham gia Vòng Bảng, mỗi account cũ khi tạo Account mới ở Vòng Loại Trực Tiếp(Vòng LTT) sẽ được nhận ưu đãi cụ thể như sau</p>
                <ul>
                    <li>
                        <p>Account cũ đã từng refill 01 lần được tặng thêm <b><?= Yii::$app->params['minBetMoney'] ?><?= Yii::$app->params['currency'] ?></b> khởi đầu cho Vòng LTT</p>
                    </li>
                    <li>
                        <p>Account cũ đã từng refill 02 lần ở Vòng Bảng được tặng thêm <b>100<?= Yii::$app->params['currency'] ?></b> khởi đầu cho Vòng LTT</p>
                    </li>
                    <li>
                        <p>Account cũ đã từng refill 03 lần ở Vòng Bảng được tặng thêm <b>100<?= Yii::$app->params['currency'] ?></b> khởi đầu cho Vòng LTT</p>
                        <p>Và sẽ được tặng thêm <b><?= Yii::$app->params['minBetMoney'] ?><?= Yii::$app->params['currency'] ?></b> (chỉ 01 lần duy nhất) cho lượt refill ở Vòng LTT này.</p>
                    </li>
                </ul>
            </li>
            <li>
                <p>Thể thức tham gia</p>
                <ul>
                    <li>
                    <p>Mỗi cá nhân hoặc tập thể tối đa được tạo <b>02 Accounts</b></p>
                    </li>
                    <li>
                    <p>Có thể nạp tiền lại (<?= Yii::$app->params['startingMoney'] ?>K) sau khi số <?= Yii::$app->params['currencyName'] ?> <b>dưới <?= Yii::$app->params['minBetMoney'] ?><?= Yii::$app->params['currency'] ?></b> (nhỏ hơn <?= Yii::$app->params['minBetMoney'] ?><?= Yii::$app->params['currency'] ?>)</p>
                    </li>
                    <li>
                    <p>01 account được <b>nạp lại 03 lần cho Vòng Bảng</b> và <b>02 lần cho Vòng Loại Trực Tiếp</b></p>
                    </li>
                    <li>
                        <p>Mỗi tài khoản phải tham gia đặt <b>ít nhất 04 trận</b>, với số điểm tối thiểu đặt trong mỗi trận phải <b>từ <?= Yii::$app->params['minBetMoney'] ?><?= Yii::$app->params['currency'] ?> trở lên</b>.</p>
                    </li>
                    <li>
                        <p>Các bạn dùng <b>Email TMA</b> để đăng ký nhưng không giới hạn cách đặt tên
                        </br>Ví dụ:</br>
                            <b> - Tên:</b> Nguyễn Bét Thủ</br>
                            <b> - Account:</b> nbthu - nbthu@***.com.vn</br>
                            <b> - NickName:</b> Shinichi Kuto
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
        <h3 class="alert alert-dark"><b>LIÊN HỆ & THANH TOÁN</b></h3>
        <p>Liên hệ <b><a target="_blank" href="<?= Yii::$app->params['adminChat'] ?>">Admin <?= Yii::$app->params['adminName'] ?></a></b> nạp tiền và tạo Account.</p>
        <div class="col-md-6">
            <p>Có thể nạp tiền mặt hoặc chuyển khoản:</p>
            <div class="table-responsive">
            <table class="table table-hover wrap-table">
            <tbody>
                <tr>
                    <th scope="row">Tên</th>
                    <td>NGUYEN MINH TUAN</td>
                </tr><tr>
                    <th scope="row">STK</th>
                    <td>31010001645607</td>
                </tr><tr>
                    <th scope="row">Ngân hàng</th>
                    <td>BIDV CN TN TpHCM</td>
                </tr><tr>
                    <th scope="row">Nội dung</th>
                    <td>TMA Account_nick_Tên Họ_wibet</td>
                </tr><tr>
                    <th scope="row"></th>
                    <td style="font-size:12px;">(VD: nmtuan_Ratman_Tuấn Nguyễn_wibet)</td>
                </tr><tr>
                    <th scope="row">QR</th>
                    <td><img class="qr-code" src="../logo.png"></td>
                </tr>
            </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-6">
            <p>Hoặc sử dụng Momo:</p>
            <div class="table-responsive">
            <table class="table table-hover wrap-table">
            <tbody>
                <tr>
                    <th scope="row">MoMo</th>
                    <td>0934719115</td>
                </tr><tr>
                    <th scope="row">Tên</th>
                    <td>Nguyễn Minh Tuấn - DC22</td>
                </tr><tr>
                    <th scope="row">Nội dung</th>
                    <td>TMA Account_nickname_Tên Họ_wibet</td>
                </tr><tr>
                    <th scope="row"></th>
                    <td style="font-size:12px;">(VD: nmtuan_Batman_Tuấn Nguyễn_wibet)</td>
                </tr><tr>
                    <th scope="row">Skype</th>
                    <td><a href="<?= Yii::$app->params['adminChat'] ?>"><?= Yii::$app->params['adminName'] ?></a></td>
                </tr><tr>
                    <th scope="row">QR</th>
                    <td><img class="qr-code" src="../logo.png"></td>
                </tr>
            </tbody>
            </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-warning notice">
                <center><span><b>*NOTE* ĐẢM BẢO XÁC THỰC *NOTE*</b></span></center></br>
                <span> - Hãy liên hệ <b><a target="_blank" href="<?= Yii::$app->params['adminChat'] ?>">Admin <?= Yii::$app->params['adminName'] ?></a></b> để nạp tiền/tạo account, Sau khi xác thực đã nhận được tiền</span></br>
                <span> - <b><a target="_blank" href="<?= Yii::$app->params['adminChat'] ?>">Admin <?= Yii::$app->params['adminName'] ?></a></b> sẽ tiến hành tạo account và liên hệ lại bạn để gửi <b>username/password</b></span></br>
                <span> - Khi nhận được <b><em>username/password</em></b>, bạn hãy tiến hành <a href="/user/default/account"><b><em>Change Password</em></b></a>
                 và <a href="/user/login"><b><em>Login</em></b></a> bằng <b>username/password</b> mới</span>
                </div>
            </div>
        </div>
        </section>
        <hr class="sl">
        <section class="col-md-12">
        <h3 class="alert alert-dark"><b>GIẢI THƯỞNG & ĐIỀU LỆ</b></h3>
        <h4>CƠ CẤU GIẢI THƯỞNG</h4>
        <p>Cơ cấu giải thưởng bao gồm:</p>
        <div class="table-responsive">
        <table class="table table-hover wrap-table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Giải</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tỷ lệ</th>
                <!-- <th scope="col">Thưởng</th> -->
                </tr>
            </thead>
            <tbody>
                <tr class="bg-success">
                    <th scope="row">1</th>
                    <td>DIAMOND</td>
                    <td>01</td>
                    <td>~30%</td>
                    <!-- <td>-</td> -->
                </tr><tr class="bg-primary">
                    <th scope="row">2</th>
                    <td>PLATINUM</td>
                    <td>01</td>
                    <td>~20%</td>
                    <!-- <td>-</td> -->
                </tr><tr class="bg-warning">
                    <th scope="row">3</th>
                    <td>GOLD</td>
                    <td>02</td>
                    <td>~10%</td>
                    <!-- <td>-</td> -->
                </tr><tr class="bg-info">
                    <th scope="row">4</th>
                    <td>SILVER</td>
                    <td>04</td>
                    <td>~05%</td>
                    <!-- <td>-</td> -->
                </tr>
            </tbody>
            </table>
            <p style="font-size:12px;">Tỷ lệ phần trăm(%) trên tổng giá trị quỹ thưởng VND (10% chi phí bảo trì và hosting)</p>
        </div>
            <h4>ĐIỀU LỆ CHƯƠNG TRÌNH</h4>
            <p>Rules chi tiết sẽ được update trực tiếp và liên tục lên web site <a href="/site/rules"><b><?= Yii::$app->params['appName'] ?></b></a></p>
            <ul>
            <li>
                <p>Tôn trọng tinh thần chung của trò chơi <b style='color:red'>"VUI LÀ CHÍNH, FAIR PLAY LÀ 10"</b></p>
            </li>
            <li>
                <p>Những hành vi gian lận trong trò chơi sẽ bị xem xét xử phạt hoặc <b>khoá tài khoản</b> mà không được bồi thường</p>
            </li>
            <li>
                <p>Bet hợp lệ là bet được tính đến thời điểm <b>05 PHÚT TRƯỚC LÚC TRỌNG TÀI THỔI CÒI BẮT ĐẦU TRẬN ĐẤU</b> (thời gian bắt đầu hiệp 01 của trận đấu đó)</p>
            </li>
            <li>
                <p>Trong trường hợp sảy ra mâu thuẫn, tranh chấp, hoặc kiện cáo, BTC sẽ xem xét phương án hoà giải và khắc phục hợp lý nhất</p>
            </li>
        </ul>
        <div class="alert alert-danger" role="alert"><b>BTC sẽ là người đưa ra quyết định cuối cùng trong mọi trường hợp !</b></div>
    </div>
    </BR></BR>
    <hr class="sl">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <center>
            <div class="alert alert-success notice">
            <h5><b>~ LỜI THÌ THẦM MÙA BET ~</b></h5>
            <span><b><?= Yii::$app->params['appName'] ?></b> là trang web mang tính chất <b>Cây Nhà Lá Vườn</b> và <b>Phi Lợi Nhuận</b></span></br>
            <span>Nhằm mục đích chính là <b>tạo sân chơi</b> và hoạt động <b>gắn kết mọi người</b> (Không nhằm mục đích cờ bạc), cũng như tạo ra một quỹ thưỡng cho tinh thần yêu bóng đá.</span></br>
            <span><b><?= Yii::$app->params['appName'] ?> Web</b> được xây dựng và bảo trì bằng <b>Extra Effort</b> của tập thể <b><?= Yii::$app->params['appName'] ?> Dev Team</b></span></br>
            <span>Cũng như sự hổ trợ cập nhật thông tin, tạo và quản lý tài khoản từ phía <b><?= Yii::$app->params['appName'] ?> Admin Team</b></span></br>
            <span>Do đó, chúng tôi hy vọng và khuyến khích các anh chị em, các bạn đồng nghiệp khi gặp khó khăn hoặc lỗi, hãy <b><a target="_blank" href="<?= Yii::$app->params['groupChat'] ?>">liên hệ với Chúng Tôi</a></b></span></br>
            <span>Để kịp thời khắc phục, và cải tiến trang web, nhằm mang đến trải nghiệm tốt nhất cho anh chị và các bạn.</span></br>
            <h3><b>Tập thể <b>BTC <?= Yii::$app->params['appName'] ?></b> xin chân thành cảm ơn !</h3>
        </div>
        </center>
    <hr class="sl">
    </div>
    </section>
    <section class="col-md-12">
    <center>
        <h4>CHÚC TOÀN THỂ ANH CHỊ EM CÓ MỘT SÂN CHƠI LÀNH MẠNH VÀ VUI VẺ TRONG KÌ <?= Yii::$app->params['seasonName'] ?></h4>
        <!-- <h5>CÙNG CHUNG TAY ĐẨY LÙI ĐẠI DỊCH - THÂN ÁI VÀ QUYẾT THẮNG</h5> -->
        <h5 style="color:blue;">
            <p><b><em>#WiBetTeam #Since2015 #DC26Activity #Euro2024</em></b></p>
        </h5>
        <h5>From <b>BTC <?= Yii::$app->params['appName'] ?></b> to you with Love</h5>
    </center>
    <br>
    <p>
        <div style="float:right;text-align:center;"><b><em><span>HCM, <?= date('l jS \of F Y') ?></span></em></b><br>
        <span><h4><b><a href="mailto:<?= Yii::$app->params['adminEmail'] ?>" target="_blank"><?= Yii::$app->params['senderName'] ?> Admin</a></b></h4>
        </span></div>
    </p>
    <br>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <br>
    </section>
</div>
