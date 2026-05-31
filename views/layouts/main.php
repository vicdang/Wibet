<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\Helper;
use app\models\AdminConfig;
use amnah\yii2\user\models\User;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
$controller = Yii::$app->controller;
$action = $controller->action->id;
$controller = $controller->id;

// Load theme and merge admin config overrides
$theme = AdminConfig::getTheme();
$overrideMap = [
    'season_name' => 'seasonName',
    'group_chat' => 'groupChat',
    'admin_chat' => 'adminChat',
    'admin_name' => 'adminName',
    'admin_email' => 'adminEmail'
];
foreach ($overrideMap as $dbKey => $paramKey) {
    $val = AdminConfig::get($dbKey);
    if ($val !== null && $val !== '') {
        Yii::$app->params[$paramKey] = $val;
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCssFile('/css/theme-dark.css?v=21'); ?>
    <?php $this->registerCssFile('/css/theme-light.css?v=21'); ?>
    <?php $this->head() ?>
</head>
<body class="<?php echo $controller .' '. $action ?>" data-theme="<?= $theme ?>">

<?php $this->beginBody() ?>
    <div class="wrap" <?php if ($controller === 'site' && $action === 'index'): ?>style="background: none !important;"<?php endif; ?>>
        <?php
            NavBar::begin([
                'brandLabel' => '<span id="brand-logo"></span>' . Yii::$app->params['appName'],
                // 'brandUrl' => Yii::$app->homeUrl,
                'brandUrl' => "/",
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'activateParents' => true,
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Stats', 'url' => ['/site/analysis'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'analysis'],
                    ['label' => 'Rules', 'url' => ['/site/rules'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'rules'],
                    ['label' => 'Ranking', 'url' => ['/ranking/index'], 'active' => Yii::$app->controller->id === 'ranking' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Tour', 'url' => ['/team/index'], 'active' => Yii::$app->controller->id === 'team' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Matches', 'url' => ['/match/index'], 'visible' => !Yii::$app->user->isGuest, 'active' => Yii::$app->controller->id === 'match' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Comments', 'url' => ['/site/comment'], 'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'comment'],
                    ['label' => 'Users', 'url' => ['/user/admin/index'], 'visible' => Yii::$app->user->can('admin'), 'active' => Yii::$app->controller->id === 'admin' && Yii::$app->controller->action->id === 'index'],
                    ['label' => 'Teams', 'url' => ['/team/admin-index'], 'visible' => Yii::$app->user->can('admin'), 'active' => Yii::$app->controller->id === 'team' && Yii::$app->controller->action->id === 'admin-index'],
                    ['label' => 'Config', 'url' => ['/config/index'], 'visible' => Yii::$app->user->can('admin'), 'active' => Yii::$app->controller->id === 'config' && Yii::$app->controller->action->id === 'index'],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/login']] :
                        ['label' => Yii::$app->user->displayName . ' <span class="badge badge-pill badge-warning u-point">' . Helper::formatMoney(Yii::$app->user->money) .'</span>', 'url'=>["/"] ,
                            'items' => [
                                [
                                    'label' => 'Account',
                                    'url' => ['/user/account'],
                                ],
                                [
                                    'label' => 'Profile',
                                    'url' => ['/user/profile'],
                                ],
                                [
                                    'label' => 'Logout',
                                    'url' => ['/user/logout'],
                                    'linkOptions' => ['data-method' => 'post']],
                                ],
                            ],

                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['appName'] ?> <?= date('Y') ?> by <a href="#" target="_blank"><?= Yii::$app->params['team'] ?></a></p>
            <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<!-- extra js -->
<!-- <script type="text/javascript" src="/js/jquery-1.8.0.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/jquery.min.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/bootstrap.min.js" 0="yii\web\JqueryAsset"></script>
<script  type="text/javascript" src="/js/bootstrap.js" 0="yii\web\JqueryAsset"></script> -->

<script  type="text/javascript" src="/js/custom.js" 0="yii\web\JqueryAsset"></script>
<!-- <script  type="text/javascript" src="/js/jquery.bracket.min.js" 0="yii\web\JqueryAsset"></script> -->
<script  type="text/javascript" src="/js/jquery.gracket.js" 0="yii\web\JqueryAsset"></script>
