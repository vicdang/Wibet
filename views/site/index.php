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
    <!-- <div id="countdown_dashboard">
        <h1>ARE YOU READY</h1>
        <ul>

            <li class="dash days_dash">
                <span class="dash_title">days</span>
                <div class="digit">0</div>
            </li>
            <li class="dash hours_dash">
                <span class="dash_title">hours</span>
                <div class="digit">0</div>
            </li>
            <li class="dash minutes_dash">
                <span class="dash_title">minutes</span>
                <div class="digit">0</div>
            </li>
            <li class="dash seconds_dash">
                <span class="dash_title">seconds</span>
                <div class="digit">0</div>
            </li>
        </ul>
    </div> -->
<!-- Countdown dashboard end -->

<div class="row">
    <div class="col-lg-3 col-xs-0"></div>
    <div class="match-current col-lg-6 offset-lg-3 col-xs-12">
        <div id="loading">
     
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent); display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="84" cy="50" r="10" fill="#000000">
                    <animate attributeName="r" repeatCount="indefinite" dur="0.25s" calcMode="spline" keyTimes="0;1" values="10;0" keySplines="0 0.5 0.5 1" begin="0s"></animate>
                    <animate attributeName="fill" repeatCount="indefinite" dur="1s" calcMode="discrete" keyTimes="0;0.25;0.5;0.75;1" values="#000000;#debc00;#5a554f;#f4ec60;#000000" begin="0s"></animate>
                </circle><circle cx="16" cy="50" r="10" fill="#000000">
                <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>
                <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"></animate>
                </circle><circle cx="50" cy="50" r="10" fill="#f4ec60">
                <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.25s"></animate>
                <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.25s"></animate>
                </circle><circle cx="84" cy="50" r="10" fill="#5a554f">
                <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.5s"></animate>
                <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.5s"></animate>
                </circle><circle cx="16" cy="50" r="10" fill="#debc00">
                <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.75s"></animate>
                <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.75s"></animate>
                </circle>
                </svg>
        </div>
        <!-- <button type="button" class="btn btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button> -->
        <ul class="unstyled-list" id="match-list">


        </ul>

    </div>
</div>
<?php $this->registerCssFile('/css/countdown.css'); ?>
<?php if (!defined('IS_ARCHIVE')) : ?>

<?php endif; ?>
