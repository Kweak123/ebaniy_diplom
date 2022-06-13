<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Services */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="services-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'style' => 'width:100%',
        ],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'col-lg-12 form-control'],
            'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
        ],
    ]); ?>

    <div class="container py-5 h-80">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="createForm" style="margin-top: -150px;">
                <div class="card text-white" style="border-radius: 1rem; background-color: rgba(0,0,0,0.8)">
                    <div class="card-body p-5 text-center">

                        <div>

                            <h2 class="fw-bold mb-2 text-uppercase" style="color: #ffffff !important;">Добавить услугу</h2>
                            <p class="text-white-50 " style="color: #ffffff !important;">Введите данные для обавления услуги</p>

                            <div class="form-outline form-white">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('') ?>
                                <label class="form-label" for="typeEmailX">Название</label>
                            </div>

                            <div class="form-outline form-white">
                                <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('') ?>
                                <label class="form-label" for="typeEmailX">Описание</label>
                            </div>

                            <div class="form-outline form-white">
                                <?= $form->field($model, 'price')->textInput()->label('') ?>
                                <label class="form-label" for="typePasswordX">Цена</label>
                            </div>

                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-outline-light btn-lg px-5 mt-5', 'name' => 'login-button']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
