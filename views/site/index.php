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

<?php endif; ?>
