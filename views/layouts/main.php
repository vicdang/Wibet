<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use amnah\yii2\user\models\User;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
$controller = Yii::$app->controller;
$action = $controller->action->id;
$controller = $controller->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?php echo $controller .' '. $action ?>">

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->params['appName'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'activateParents' => true,
                'items' => [
                    ['label' => '<i class="fa fa-home"></i> Home', 'url' => ['/site/index']],
		    ['label' => '<i class="fa fa-quote-left"></i> Rules', 'url' => ['/site/rules']],
		    ['label' => '<i class="fa fa-comment"></i> Comments', 'url' => ['/site/comment']],
                    ['label' => '<i class="fa fa-signal"></i> Ranking', 'url' => ['/user/default/ranking']],
                    ['label' => '<i class="fa fa-calendar"></i> Matches', 'url' => ['/match/index'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => '<i class="fa fa-user"></i> Users', 'url' => ['/user/admin/index'], 'visible' => Yii::$app->user->can('admin')],
                    Yii::$app->user->isGuest ?
                        ['label' => '<i class="fa fa-sign-in"></i> Login', 'url' => ['/user/default/login']] :
                        ['label' => '<i class="fa fa-chevron-right"></i> ' . Yii::$app->user->displayName . ' ($' . Yii::$app->user->money .')',
                            'items' => [
                                [
                                    'label' => 'Account',
                                    'url' => ['/user/default/account'],
                                ],
                                [
                                    'label' => 'Profile',
                                    'url' => ['/user/default/profile'],
                                ],
                                [
                                    'label' => 'Logout',
                                    'url' => ['/user/default/logout'],
                                    'linkOptions' => ['data-method' => 'post']],
                                ],
                            ],

                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::$app->params['appName'] ?> <?= date('Y') ?> by <a href="#" target="_blank">DC22-Dev</a></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
