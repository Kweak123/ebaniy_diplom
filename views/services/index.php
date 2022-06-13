<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

/* @var $searchModel app\models\ServicesSearch */
/* @var $searchModelU app\models\UserSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderU yii\data\ActiveDataProvider */


/* @var $model app\models\Services */
/* @var $modelU app\models\User */

/* @var $form yii\widgets\ActiveForm */

$this->title = 'Админ Панель';
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home" style="color: #000000">Информация</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu11" style="color: #000000">Оформленные услуги</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1" style="color: #000000">Пользователи</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu2" style="color: #000000">Услуги</a>
    </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
        <div class="row justify-content-center" style="max-width: 1000px">

            <div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 20rem; ; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Пользователи</div>
                <div class="card-body d-flex justify-content-center flex-column ">
                    <h5 class="card-title mb-3 text-center">Кол-во пользователей:</h5>
                    <p class="card-text" style="color: white; font-size: 60px; text-align: center"><?= \app\models\User::find()->where(['user_role' => 2])->count() ?></p>
                </div>
            </div>

            <div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 20rem; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Оказанные услуги</div>
                <div class="card-body d-flex justify-content-center flex-column">
                    <h5 class="card-title mb-3 text-center">Кол-во оказынных услуг:</h5>
                    <p class="card-text" style="color: white; font-size: 60px; text-align: center"><?= \app\models\PurchasedService::find()->count() ?></p>
                </div>
            </div>

            <div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 20rem; ; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Прибыль</div>
                <div class="card-body d-flex justify-content-center flex-column">
                    <h5 class="card-title mb-3 text-center">Общая выручка:</h5>
                    <p class="card-text" style="color: white; font-size: 30px; text-align: center"><?= \app\models\PurchasedService::find()->sum('price') ?> руб</p>
                </div>
            </div>

        <?= Html::a('<div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 20rem; ; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Создание услуги</div>
                <div class="card-body d-flex justify-content-center flex-column">
                    <h5 class="card-title mb-3 text-center" style="font-size: 30px">Создать услугу</h5>
                </div>
            </div>', 'create') ?>


            <?= Html::a(' <div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 18rem; ; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Профиль</div>
                <div class="card-body d-flex justify-content-center flex-column">
                    <h5 class="card-title mb-3 text-center"  style="font-size: 30px">Просмотреть профиль</h5>
                </div>
            </div>', 'adminprofile') ?>

        </div>
    </div>

    <div id="menu11" class="container tab-pane fade"><br>
        <h3>Оформленные услуги</h3>
        <table class="table table-striped" style="width: 80rem !important;">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Телефон</th>
                <th scope="col">Услуга</th>
                <th scope="col">Цена</th>
                <th scope="col">Дата</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $clientArray = \app\models\IssuedService::find()->asArray()->all();
            $count = 1;
            foreach ($clientArray as $client) :
                ?>
                <tr class="text-center">

                    <th scope="row"><?= $count ?></th>
                    <?php $serviceInfo = \app\models\Services::getServiceInfo($client['service_id']); ?>
                    <td><?= $client['full_name']?></td>
                    <td><?= $client['telephone_number']?></td>
                    <td><?= $serviceInfo[0]['name']?></td>
                    <td><?= $serviceInfo[0]['price']?> руб</td>
                    <td><?= $client['date_time']?></td>
                    <td><?= $client['status']?></td>
                    <?php $count++ ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="menu1" class="container tab-pane fade"><br>
        <h3>Пользователи</h3>
        <?= GridView::widget([
            'dataProvider' => $dataProviderU,
            'filterModel' => $searchModelU,
            'tableOptions' => [
                'class' => 'table table-bordered table-hover my-table'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'login',
                'email:email',
                'user_role',
            ],
        ]); ?>
    </div>

    <div id="menu2" class="container tab-pane fade"><br>
        <h3>Услуги</h3>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => [
                'class' => 'table table-bordered table-hover my-table'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'description',
                'price',

                ['class' => 'yii\grid\ActionColumn',
                    'header' => 'Действия',
                    'headerOptions' => ['width' => '80']],
            ],
        ]); ?>
    </div>
</div>

