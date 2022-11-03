<?php
/**
 * @var yii\web\View $this
 */
$this->title = Yii::$app->params['appName'];

?>
<!-- Countdown dashboard start -->
    <div id="countdown_dashboard">
        <h1>ARE YOU READY</h1>
        <ul>
            <li class="dash weeks_dash">
                <span class="dash_title">weeks</span>
                <div class="digit">0</div>
                <div class="digit">0</div>
            </li>
            <li class="dash days_dash">
                <span class="dash_title">days</span>
                <div class="digit">0</div>
                <div class="digit">0</div>
            </li>
            <li class="dash hours_dash">
                <span class="dash_title">hours</span>
                <div class="digit">0</div>
                <div class="digit">0</div>
            </li>
            <li class="dash minutes_dash">
                <span class="dash_title">minutes</span>
                <div class="digit">0</div>
                <div class="digit">0</div>
            </li>
            <li class="dash seconds_dash">
                <span class="dash_title">seconds</span>
                <div class="digit">0</div>
                <div class="digit">0</div>
            </li>
        </ul>
    </div>
	
<!-- Countdown dashboard end -->
<?php $this->registerCssFile('/css/countdown.css'); ?>
<?php if (!defined('IS_ARCHIVE')) : ?>
<?php $this->registerJsFile(
    //'/js/clock.js',
    '/js/jquery.lwtCountdown-1.0.js',
    [\yii\web\JqueryAsset::className()]
); ?>

<?php $this->registerJs("
    $('#countdown_dashboard').countDown({
        targetDate: {
            'day':      12,
            'month':    6,
            'year':     2021,
            'hour':     2,
            'min':      00,
            'sec':      0
        }
    });
", \yii\web\View::POS_READY); ?>
<?php endif; ?>
