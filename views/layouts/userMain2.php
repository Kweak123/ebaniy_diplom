<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">

    <head>

        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
    <div class="tm-page-wrap mx-auto">
        <div class="position-relative">
            <div class="position-absolute tm-site-header">
                <div class="container-fluid position-relative">
                    <div class="row">
                        <div class="col-7 col-md-4">
                            <a href="/web/index.php?r=site%2Findex" class="tm-bg-black text-center tm-logo-container">
                                <div class="logo mb-3" style="background: url('/web/images/logo.png')"></div>
                                <h1 class="tm-site-name">Etere</h1>
                            </a>
                        </div>
                        <div class="col-5 col-md-8 ml-auto mr-0">
                            <div class="tm-site-nav">
                                <nav class="navbar navbar-expand-lg mr-0 ml-auto" id="tm-main-nav">
                                    <button class="navbar-toggler tm-bg-black py-2 px-3 mr-0 ml-auto collapsed"
                                            type="button"
                                            data-toggle="collapse" data-target="#navbar-nav" aria-controls="navbar-nav"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                        <span>
                                            <i class="fas fa-bars tm-menu-closed-icon"></i>
                                            <i class="fas fa-times tm-menu-opened-icon"></i>
                                        </span>
                                    </button>
                                    <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                                        <?php NavBar::begin([
                                            'brandUrl' => Yii::$app->homeUrl,
                                            'options' => [
                                                'class' => 'navbar navbar-expand-lg',
                                            ],
                                        ]);
                                        echo Nav::widget([
                                            'options' => ['class' => 'navbar-nav text-uppercase align-items-center'],
                                            'items' => [
                                                ['label' => 'Главная', 'url' => ['/']],
                                                ['label' => 'О нас', 'url' => ['/site/about']],
                                                Yii::$app->user->isGuest ? '' : (['label' => 'Личный кабинет', 'url' => ['/site/lk']]),
                                                Yii::$app->user->isGuest ? (
                                                ['label' => 'Авторизация', 'url' => ['/site/login']]
                                                ) : (
                                                    '<li>'
                                                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'nav-link nav-item'])
                                                    . Html::submitButton(
                                                        'Выход (' . Yii::$app->user->identity->login . ')',
                                                        ['class' => 'myBtnLogoutClass']
                                                    )
                                                    . Html::endForm()
                                                    . '</li>'
                                                ),
                                                Yii::$app->user->isGuest ? (
                                                ['label' => 'Регистрация', 'url' => ['/site/reg']]
                                                ) : '',
                                            ],
                                        ]);
                                        NavBar::end(); ?>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="tm-video-container" style="max-height:  280px !important;">
                <video autoplay muted loop id="tm-video" style="height: 980px !important;">
                    <source src="/web/video/wheat-field.mp4" type="video/mp4">
                </video>
            </div>



        </div>

        <div class="tm-welcome-containerAdmin">
            <?= $content ?>
        </div>
    </div>




    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>