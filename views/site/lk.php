<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */



/* @var $model app\models\Services */
/* @var $modelU app\models\User */

/* @var $form yii\widgets\ActiveForm */

$this->title = 'Админ Панель';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
?>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home" style="color: #000000">Информация</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1" style="color: #000000">Оформленные услуги</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
        <div class="row justify-content-center" style="max-width: 1000px">

            <div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 20rem; ; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Кол-во услуг</div>
                <div class="card-body d-flex justify-content-center flex-column ">
                    <h5 class="card-title mb-3 text-center">Кол-во купленных услуг:</h5>
                    <p class="card-text" style="color: white; font-size: 60px; text-align: center"><?= \app\models\PurchasedService::find()->where(['user_id' => $session['__id']])->count() ?></p>
                </div>
            </div>


            <?= Html::a(' <div class="card text-white bg-secondary mb-3 mr-3" style="max-width: 18rem; ; min-width: 18rem; min-height: 16rem">
                <div class="card-header text-center">Профиль</div>
                <div class="card-body d-flex justify-content-center flex-column">
                    <h5 class="card-title mb-3 text-center"  style="font-size: 30px">Просмотреть профиль</h5>
                </div>
            </div>', 'userprofile') ?>
        </div>
    </div>


    <div id="menu1" class=" tab-pane fade"><br>
        <h3 class="text-center">Оформленные услуги</h3>
        <?php $form = ActiveForm::begin(); ?>
        <table class="table table-striped" style="width: 80rem !important;">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Услуга</th>
                <th scope="col">Цена</th>
                <th scope="col">Дата</th>
                <th scope="col">Статус</th>
                <th scope="col">Купить</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $session = Yii::$app->session;
                $clientArray = \app\models\IssuedService::find()->asArray()->where(['user_id' => $session['__id']])->andWhere(['status' => 'Новый'])->all();
                $count = 1;
                foreach ($clientArray as $client) :
                ?>
                <tr class="text-center">

                <th scope="row"><?= $count ?></th>
                <?php $serviceInfo = \app\models\Services::getServiceInfo($client['service_id']); ?>
                <td><?= $client['full_name']?></td>
                <td><?= $serviceInfo[0]['name']?></td>
                <td><?= $serviceInfo[0]['price']?> руб</td>
                <td><?= $client['date_time']?></td>
                <td><?= $client['status']?></td>
                <td><?= Html::submitButton('Купить', ['class' => 'buyService', 'name' => 'buy-service-button', 'value' => $client['id']]) ?></td>
                <?php $count++ ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php ActiveForm::end(); ?>
    </div>


</div>

