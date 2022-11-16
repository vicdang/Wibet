<?php
/**
 * @var yii\web\View $this
 */
$this->title = Yii::$app->params['appName'];

?>
<style>
    #countdown_dashboard{
        overflow: hidden;
        margin-top: 100px;
    }
    #countdown_dashboard ul li {
        background: none;
        background-color: #ffffffc1;
        border-radius: 20px;
        border: 1px solid #ada8a8;
        height: 120px;
    }
    .dash .digit{
        width: 110px;
    }
    .dash_title {
        position: relative;
        bottom: -10px;
        right: 0;
        color: gray;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: none;
    }
</style>
<!-- Countdown dashboard start -->
    <div id="countdown_dashboard">
        <h1>ARE YOU READY</h1>
        <ul>
            <!-- <li class="dash weeks_dash">
                <span class="dash_title">weeks</span>
                <div class="digit">0</div>
                <div class="digit">0</div>
            </li> -->
            <li class="dash days_dash">
                <span class="dash_title">days</span>
                <div class="digit">0</div>
                <!-- <div class="digit">0</div> -->
            </li>
            <li class="dash hours_dash">
                <span class="dash_title">hours</span>
                <div class="digit">0</div>
                <!-- <div class="digit">0</div> -->
            </li>
            <li class="dash minutes_dash">
                <span class="dash_title">minutes</span>
                <div class="digit">0</div>
                <!-- <div class="digit">0</div> -->
            </li>
            <li class="dash seconds_dash">
                <span class="dash_title">seconds</span>
                <div class="digit">0</div>
                <!-- <div class="digit">0</div> -->
            </li>
        </ul>
    </div>
	
<!-- Countdown dashboard end -->
<?php $this->registerCssFile('/css/countdown.css'); ?>
<?php if (!defined('IS_ARCHIVE')) : ?>
<script type="text/javascript" src="/js/jquery-1.8.0.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/jquery.min.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/bootstrap.min.js" 0="yii\web\JqueryAsset"></script>
<script  type="text/javascript" src="/js/bootstrap.js" 0="yii\web\JqueryAsset"></script>




<!-- <script type="text/javascript">
$(document).ready(function () {

    $('#countdown_dashboard').countDown({
        targetDate: {
            'day':      20,
            'month':    12,
            'year':     2022,
            'hour':     0,
            'min':      00,
            'sec':      0
        }
    });



}); -->
<script type="text/javascript">
    var end = new Date('11/20/2022 11:00 PM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            //document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        $('.days_dash .digit').html(days);
        $('.hours_dash .digit').html(hours);
        $('.minutes_dash .digit').html(minutes);
        $('.seconds_dash .digit').html(seconds);
        //console.log(end);
    }

    timer = setInterval(showRemaining, 1000);
</script>
<?php endif; ?>
