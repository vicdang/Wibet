<?php
use yii\helpers\Html;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 */
$this->title = 'Rules';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    $params = Yii::$app->params;
    $total = $params['totalAmount'];
    $p1 = Helper::calculatePrices($total, $params['p1Rate'], $params['p1Count']);
    $p2 = Helper::calculatePrices($total, $params['p2Rate'], $params['p2Count']);
    $p3 = Helper::calculatePrices($total, $params['p3Rate'], $params['p3Count']);
    $p4 = Helper::calculatePrices($total, $params['p4Rate'], $params['p4Count']);
    $p5 = Helper::calculatePrices($total, $params['p5Rate'], $params['p5Count']);
?>

</pre>
<div class="site-rules">
    <!-- <h1><?= Html::encode($this->title) ?></h1>-->
    <div id="rules-content">
        <center>
            <h1><b>THỂ LỆ THAM GIA CHƯƠNG TRÌNH</b></h1>
        </center>
        <hr>
        <section class="col-md-12">
        <h3 class="alert alert-dark block"><b>THỂ THỨC CHUNG</b></h3>
        <div class="col-lg-12">
        <ul>
            <li>
                <p>Chương trình <b><?= $params['appName'] ?></b> sẽ được chia làm 02 vòng đấu. <b><em>Giải thưởng sẽ
                            được tổng kết và trao sau mỗi vòng</em></b>.</p>
                <ul>
                    <li>
                        <p><b>Vòng Bảng(VB)</b>: Từ trận đầu tiên đến vòng đầu cuối cùng của vòng bảng <?= $params['seasonName'] ?></p>
                    </li>
                    <li>
                        <p><b>Vòng Loại Trực Tiếp(LTT)</b>: Tất cả các trận đấu từ vòng đấu loại trực tiếp cho đến trận chung kết</p>
                    </li>
                </ul>
            </li>
            <li>
                <p>Mỗi Cá nhân/Tập thể được tạo <b>tối đa 02 Accounts</b> bằng cách liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>">Admin <?= $params['adminName'] ?></a></b> để nạp tiền</p>
                <ul>
                    <li>
                        <p>Chỉ với <span class="badge badge-pill badge-success"><?= $params['minPayMoney'] ?>.000 VND</span> Account của bạn sẽ ngay lập tức được <span class="badge badge-pill badge-success">Activated</span> và sở hữu <b><span class="badge badge-pill badge-warning"><?= $params['minPayMoney'] ?><?= $params['currency'] ?></span> khởi đầu</b></p>
                    </li>
                    <li>
                        <p>Ở mỗi vòng đấu, một account chỉ có thể nạp thêm:<p>
                        <p>- <b>Tối thiểu</b> <span class="badge badge-pill badge-warning"><?= $params['minPayMoney'] ?><?= $params['currency'] ?></span> cho mỗi lần nạp, số tiền nạp phải là bội số của <span class="badge badge-pill badge-warning"><?= $params['minPayMoney'] ?><?= $params['currency'] ?></span></p>
                        <p style="font-size:14px;"><b><em>(vd: 100w, 200w, 300w, 400w, 500w, 600w, 700w)</em></b></p>
                        <p>- <b>Tối đa</b> <span class="badge badge-pill badge-warning"><?= $params['maxPayMoney'] ?><?= $params['currency'] ?></span> cho mỗi account</p>
                        <p style="font-size:14px;"><b><em>(Mỗi account không được nạp quá <?= $params['maxPayMoney'] ?><?= $params['currency'] ?>)</em></b></p>
                    </li>
                    <li>
                        <p>Giá trị quy đổi: <span class="badge badge-pill badge-success">1.000 VND</span> tương ứng <span class="badge badge-pill badge-warning">1<?= $params['currency'] ?></span></p>
                        <p style="font-size:14px;"><b><em>(<?= $params['currencyName'] ?> được dùng làm đơn vị đo lường trong trò chơi để tìm ra người chiến thắng, và KHÔNG có giá trị quy đổi thành tiền mặt)</em></b></p>
                    </li>
                </ul>
            </li>
            <li>
                <p>Cổng thanh toán sẽ mở vào lúc <span class="badge badge-pill badge-success">09h00</span> và đóng lúc <span class="badge badge-pill badge-warning">22h30</span> hàng ngày</p>
            </li>
            <li>
                <p>Những giao dịch phát sinh sau <span class="badge badge-pill badge-danger">22h30</span> sẽ được tiến hành vào <span class="badge badge-pill badge-warning">09h00</span> ngày hôm sau</p>
            </li>
            <li>
                <p>Cổng thanh toán sẽ kết thúc vòng vào <span class="badge badge-pill badge-danger">18h00</span> trước 03 ngày kết thúc lượt trận cuối cùng (hoặc 6 trận cuối)</p>
            </li>
        </ul>
        </div>
            <div class="col-lg-12">
            <h3 class="alert alert-dark block"><b>QUY TẮC THAM GIA</b></h3>
                <ul>
                    <li>
                    <p>Mỗi Cá nhân hoặc Tập thể được tạo tối đa <b>02 Accounts</b></p>
                    </li>
                    <li>
                    <p>Có thể nạp tiền thêm <b>BẤT CỨ KHI NÀO BẠN MUỐN</b></p>
                    </li>
                    <li>
                    <p>Tip: Nhớ chú ý khung giờ mở cổng nạp, và số lượng <span class="badge badge-pill badge-warning"><?= $params['currencyName'] ?></span> còn lại mà bạn có thể nạp để có chiến thuật tốt nhất nhé !
                    </li>
                    <li>
                        <p>Mỗi tài khoản cần phải tham gia đặt <b>tối thiểu 04 trận</b>, với số điểm tối thiểu cần đặt cho mỗi trận là <b><span class="badge badge-pill badge-warning"><?= $params['minBetMoney'] ?><?= $params['currency'] ?></span></b> và tối đa là tổng số <?= $params['currencyName'] ?> mà bạn đang sở hữu</p>
                    </li>
                    <li>
                        <p>Các bạn dùng <b>Email TMA</b> để đăng ký nhưng không giới hạn cách đặt tên
                        </br>Ví dụ:</br>
                            <b> - Tên:</b> Man Văn Bét</br>
                            <b> - Account:</b> mvbet - mvbet@***.com.vn</br>
                            <b> - NickName:</b> Bét Man
                        </p>
                    </li>
                    <li>
                        <p>Trong trường hợp có 02 hoặc nhiều người bằng điểm nhau thì người nào có <b>số lần đặt cược nhiều hơn</b> sẽ thắng, nếu mọi thứ như nhau thì chia đều giải thưởng</p>
                    </li>
                </ul>
                <p>Khuyến khích các quỹ tập thể tham gia và được đứng tên với tên Team tương ứng</p>
        </div>
        <section class="col-md-12">
        <h3 class="alert alert-dark block"><b>LIÊN HỆ & THANH TOÁN</b></h3>
        <p>Liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>">Admin <?= $params['adminName'] ?></a></b> nạp tiền và tạo Account.</p>
        <div class="col-md-6">
            <p>Có thể nạp tiền mặt hoặc chuyển khoản:</p>
            <div class="table-responsive">
            <table class="table table-hover wrap-table">
            <tbody>
                <tr>
                    <th scope="row">Tên</th>
                    <td><?= $params['bankName'] ?></td>
                </tr><tr>
                    <th scope="row">STK</th>
                    <td><?= $params['bankID'] ?></td>
                </tr><tr>
                    <th scope="row">Ngân hàng</th>
                    <td><?= $params['bankBrand'] ?></td>
                </tr><tr>
                    <th scope="row">Nội dung</th>
                    <td>[TMA Account]_[nickname]_[Tên Họ]_wb</td>
                </tr><tr>
                    <th scope="row"></th>
                    <td style="font-size:12px;">(VD: mvbet_Betman_Bét Man_wb)</td>
                </tr><tr>
                    <th scope="row">QR</th>
                    <td><a href="<?= $params['bankLink'] ?>"><img class="qr-code" src="../images/qr/bank-qr.png"></a></td>
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
                    <th scope="row">Tên</th>
                    <td><?= $params['momoName'] ?></td>
                </tr>
                    <th scope="row">MoMo</th>
                    <td><?= $params['momoNumb'] ?></td>
                </tr><tr>
                    <th scope="row">Skype</th>
                    <td><a href="<?= $params['adminChat'] ?>"><?= $params['adminName'] ?></a></td>
                </tr><tr>
                    <th scope="row">Nội dung</th>
                    <td>[TMA Account]_[nickname]_[Tên Họ]_wb</td>
                </tr><tr>
                    <th scope="row"></th>
                    <td style="font-size:12px;">(VD: mvbet_Betman_Bét Man_wb)</td>
                </tr><tr>
                    <th scope="row">QR</th>
                    <td><a href=""><img class="qr-code" src="../images/qr/momo-qr.png"></a></td>
                </tr>
            </tbody>
            </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-warning notice">
                <center><span><b><span class="glyphicon glyphicon-warning-sign"></span> ĐẢM BẢO XÁC THỰC <span class="glyphicon glyphicon-warning-sign"></span></b></span></center></br>
                <span> - Hãy liên hệ <b><a target="_blank" href="<?= $params['adminChat'] ?>">Admin <?= $params['adminName'] ?></a></b> để nạp tiền và tạo account, Sau khi xác thực đã nhận được tiền</span></br>
                <span> - <b><a target="_blank" href="<?= $params['adminChat'] ?>">Admin <?= $params['adminName'] ?></a></b> sẽ tiến hành tạo account và liên hệ lại bạn để gửi <b>username/password</b></span></br>
                <span> - Khi nhận được <b><em>username/password</em></b>, bạn hãy tiến hành <a href="/user/default/account"><b><em>Change Password</em></b></a>
                 và <a href="/user/login"><b><em>Login</em></b></a> bằng <b>username/password</b> mới</span>
                </div>
            </div>
        </div>
        <hr class="sl">
        </section>
            <!-- <li> -->
            
                <div class="col-lg-12">
                <h3 class="alert alert-dark block"><b>MỨC ĐỘ TRUY CẬP MỖI VÒNG ĐẤU</b></h3>
                    <div class="table-responsive">
                        <table class="table table-hover wrap-table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Mục</th>
                                    <th scope="col">Chi tiết</th>
                                    <th scope="col">VB</th>
                                    <th scope="col">LTT</th>
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
            <div class="col-lg-12">
            <h3 class="alert alert-dark block"><b>TRI ÂN BET THỦ</b></h3>
        <ul>
            <li>
                <p>Nhằm tri ân những Accounts đã tham gia Vòng Bảng (VB), mỗi account cũ khi tạo Account mới ở Vòng Loại Trực Tiếp (LTT) sẽ được nhận ưu đãi cụ thể như sau</p>
                <ul>
                    <li>
                        <p>Account cũ đã từng nạp đạt mốc <span class="badge badge-pill badge-warning">400<?= $params['currency'] ?></span> được tặng thêm <span class="badge badge-pill badge-warning"><?= $params['minBetMoney'] ?><?= $params['currency'] ?></span></p>
                    </li>
                    <li>
                    <p>Account cũ đã từng nạp đạt mốc <span class="badge badge-pill badge-warning">600<?= $params['currency'] ?></span> được tặng thêm <span class="badge badge-pill badge-warning">100<?= $params['currency'] ?></span></p>
                    </li>
                    <li>
                    <p>Account cũ đã từng nạp đạt mốc <span class="badge badge-pill badge-warning">800<?= $params['currency'] ?></span> được tặng thêm <span class="badge badge-pill badge-warning">200<?= $params['currency'] ?></span></p>
                    </li>
                </ul>
            </li>
        </ul>
        <hr class="sl">
        </section>
        <section class="col-md-12">
        <h3 class="alert alert-dark block"><b>GIẢI THƯỞNG & ĐIỀU LỆ</b></h3>
        <h4>CƠ CẤU GIẢI THƯỞNG</h4>
        <p>Cơ cấu giải thưởng bao gồm:</p>
        <h4>Tổng giá trị giải thưởng: <span class="badge badge-pill badge-success"><?= number_format($params['totalAmount'],0) ?><?= $params['currencyReal']?></span></h4>
        <div class="table-responsive">
        <table class="table table-hover wrap-table">
            <thead>
                <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Giải</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tỷ lệ</th>
                <th scope="col">Giá Trị</th>
                <th scope="col">Tổng</th>
                <th scope="col">Quà</th>
                <!-- <th scope="col">Thưởng</th> -->
                </tr>
            </thead>
            <tbody>
                <tr class="bg-danger">
                    <!-- <th scope="row">1</th> -->
                    <td>DIAMOND</td>
                    <td><?= $params['p1Count'] ?></td>
                    <td>~<?= $params['p1Rate'] ?>%</td>
                    <td>~<?= $p1['price'] ?><?= $params['currencyReal']?></td>
                    <td>~<?= $p1['total'] ?><?= $params['currencyReal']?></td>
                    <td><img class="gift sm" src="../images/gift/gift_1.jpg"></td>
                    <!-- <td>-</td> -->
                </tr><tr class="bg-primary">
                    <!-- <th scope="row">2</th> -->
                    <td>PLATINUM</td>
                    <td><?= $params['p2Count'] ?></td>
                    <td>~<?= $params['p2Rate'] ?>%</td>
                    <td>~<?= $p2['price'] ?><?= $params['currencyReal']?></td>
                    <td>~<?= $p2['total'] ?><?= $params['currencyReal']?></td>
                    <td><img class="gift sm" src="../images/gift/gift_1.jpg"></td>
                    <!-- <td>-</td> -->
                </tr><tr class="bg-warning">
                    <!-- <th scope="row">3</th> -->
                    <td>GOLD</td>
                    <td><?= $params['p3Count'] ?></td>
                    <td>~<?= $params['p3Rate'] ?>%</td>
                    <td>~<?= $p3['price'] ?><?= $params['currencyReal']?></td>
                    <td>~<?= $p3['total'] ?><?= $params['currencyReal']?></td>
                    <td><img class="gift sm" src="../images/gift/gift_1.jpg"></td>
                    <!-- <td>-</td> -->
                </tr><tr class="bg-success">
                    <!-- <th scope="row">4</th> -->
                    <td>SILVER</td>
                    <td><?= $params['p4Count'] ?></td>
                    <td>~<?= $params['p4Rate'] ?>%</td>
                    <td>~<?= $p4['price'] ?><?= $params['currencyReal']?></td>
                    <td>~<?= $p4['total'] ?><?= $params['currencyReal']?></td>
                    <td><img class="gift sm" src="../images/gift/gift_1.jpg"></td>
                    <!-- <td>-</td> -->
                </tr>
                </tr><tr class="bg-info">
                    <!-- <th scope="row">5</th> -->
                    <td>Bet4Fun</td>
                    <td><?= $params['p5Count']?></td>
                    <td><?= $params['p5Rate']?></td>
                    <td><img class="gift sm" src="../images/gift/gift_1.jpg"></td>
                    <td><img class="gift sm" src="../images/gift/gift_1.jpg"> <b>x5</b></td>
                    <td> - </td>
                    <!-- <td>-</td> -->
                </tr>
            </tbody>
            </table>
            <p style="font-size:14px;"> - Tỷ lệ phần trăm(%) trên tổng giá trị quỹ thưởng VND (bao gồm <?= $params['adjRate'] ?>% giải bổ sung, <?= $params['mtRate'] ?>% phí bảo trì và hosting)</p>
        </div>
        <div>
        <center>
            <p> Phần quà tặng kèm là <?=$params['giftItem']?> từ chương trình <?=$params['appName']?></p>
            <p><img class="gift lg" src="../images/gift/gift_1.jpg"></p>
        </center>
        <div>
        <hr class="sl">
            <h3 class="alert alert-dark block"><b>ĐIỀU LỆ CHƯƠNG TRÌNH</b></h3>
            <p>Rules chi tiết sẽ được update trực tiếp và liên tục lên web site <a href="/site/rules"><b><?= $params['appName'] ?></b></a></p>
            <ul>
            <li>
                <p>Tôn trọng tinh thần chung của trò chơi <b style='color:red'>"VUI LÀ CHÍNH, FAIR PLAY LÀ 10"</b></p>
            </li>
            <li>
                <p>Những hành vi gian lận trong trò chơi, hoặc lợi dụng lổ hổng của hệ thống để trục lợi sẽ bị xem xét xử phạt hoặc buộc <b>khoá tài khoản</b> và không được bồi thường</p>
                <p style="font-size:14px;"><b><em> - Hãy là một Bét Thủ chân chính bạn nhé <span class="glyphicon glyphicon-heart"></span></em></b></p>
            </li>
            <li>
                <p>Kết quả trận đấu là tỉ số được ghi nhận trong <b>02 Hiệp đấu chính thức</b> của trận, bao gồm thời gian bù giờ của trận đấu đó</p>
                <p style="font-size:14px;"><b><em> - Không tính kết quả hiệp phụ, kết quả đá luân lưu, và kết quả bốc thăm nếu có</em></b></p>
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
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div class="box">
            <div class="content">
        <!-- <div class="alert alert-success notice"> -->
        <center>
            <h5><b><span class="glyphicon glyphicon-heart-empty"></span> LỜI THÌ THẦM MÙA BET <span class="glyphicon glyphicon-heart-empty"></span></b></h5>
            <span><b><?= $params['appName'] ?></b> là trang web mang tính chất <b>Cây Nhà Lá Vườn</b> và <b>Phi Lợi Nhuận</b></span></br>
            <span>Nhằm mục đích chính là <b>tạo sân chơi</b> và hoạt động <b>gắn kết mọi người</b>, cũng như tạo ra một quỹ thưỡng cho tinh thần yêu bóng đá (KHÔNG nhằm mục đích cờ bạc).</span></br>
            <span><b><?= $params['appName'] ?> Web</b> được xây dựng và bảo trì bởi <b>Extra Effort</b> của tập thể <b><?= $params['appName'] ?> Dev Team</b>
            , và sự hổ trợ cập nhật thông tin, tạo và quản lý tài khoản từ phía <b><?= $params['appName'] ?> Admin Team</b></span></br>
            <span>Do đó, chúng tôi hy vọng và khuyến khích các anh chị em, các bạn đồng nghiệp khi gặp khó khăn hoặc lỗi, hãy <b><a target="_blank" href="<?= $params['groupChat'] ?>">liên hệ với Chúng Tôi</a></b></span></br>
            <span>Để kịp thời khắc phục, và cải tiến trang web, nhằm mang đến trải nghiệm tốt nhất cho anh chị em và các bạn.</span></br>
            <h3><b>Tập thể <b>BTC <?= $params['appName'] ?></b> xin chân thành cảm ơn !</h3>
            </center>
    <!-- </div> -->
</div>
</div>
    <hr class="sl">
    </div>
    </section>
    <section class="col-md-12">
    <center>
        <h4>CHÚC TOÀN THỂ ANH CHỊ EM CÓ MỘT SÂN CHƠI LÀNH MẠNH VÀ VUI VẺ TRONG KÌ <?= $params['seasonName'] ?></h4>
        <!-- <h5>CÙNG CHUNG TAY ĐẨY LÙI ĐẠI DỊCH - THÂN ÁI VÀ QUYẾT THẮNG</h5> -->
        <h5 style="color:blue;">
            <p><b><em>#WiBetTeam #Since2015 #DC26Activity #Euro2024</em></b></p>
        </h5>
        <h5>From <b>BTC <?= $params['appName'] ?></b> to you with Love</h5>
    </center>
    <br>
    <p>
        <div style="float:right;text-align:center;"><b><em><span>HCM, <?= date('l jS \of F Y') ?></span></em></b><br>
        <span><h4><b><a href="mailto:<?= $params['adminEmail'] ?>" target="_blank"><?= $params['senderName'] ?> Admin</a></b></h4>
        </span></div>
    </p>
    <br>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <br>
    </section>
</div>
