<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap4\ActiveForm;

/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var yii\web\View $this */
/* @var $modelW app\models\Wishes */
/* @var $searchModel app\models\ServicesSearch */

?>

<div class="container-fluid">
    <div id="content" class="mx-auto tm-content-container">
        <main>
            <div class="row">
                <div class="col-12">
                    <h2 class="tm-page-title mb-4 text-center">Наши услуги</h2>
                </div>
            </div>

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '<div class="row tm-catalog-item-list justify-content-center">{items}</div>',
                'itemView' => '_card'
            ]); ?>

        </main>

        <div class="row mt-5 pt-3 justify-content-center">
            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="tm-bg-gray p-5 h-100">
                    <h3 class="mb-3">Хотите оставить пожелания?</h3>
                    <p class="mb-1">Если у вас есть какие-то пожелания к сайту, можете оставить их здесь и мы
                        обязательно прислушаемся к вам.</p>
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'row justify-content-space-around align-items-flex-end'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'inputOptions' => ['class' => 'col-lg-12 form-control'],
                            'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
                        ],
                    ]); ?>
                    <?= $form->field($modelW, 'content')->textarea()->label('') ?>
                    <?= Html::submitButton('Отправить', ['class' => 'btn rounded-0 tm-btn-small',
                        'name' => 'wishButton', 'style' => 'background-color: rgba(0,0,0,0.3); height: 44px']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <footer class="row pt-5">
            <div class="col-12">
                <p class="text-right">Copyright 2022 Etere</p>
            </div>
        </footer>
    </div>
</div>


