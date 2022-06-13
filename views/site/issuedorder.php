<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\IssuedService $modelI */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
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
        <div class="col-12 col-md-8 col-lg-6 col-xl-5" style="margin-top: -3.5rem">
            <div class="card text-white" style="border-radius: 1rem; background-color: rgba(0,0,0,0.8)">
                <div class="card-body p-5 text-center">

                    <div>

                        <h2 class="fw-bold mb-2 text-uppercase" style="color: #ffffff !important;">Оформление услуги</h2>
                        <p class="text-white-50 " style="color: #ffffff !important;">Введите данные для оформления услуги</p>

                        <div class="form-outline form-white">
                            <?= $form->field($modelI, 'full_name')->textInput(['autofocus' => true])->label('') ?>
                            <label class="form-label" for="typeEmailX">ФИО</label>
                        </div>

                        <div class="form-outline form-white">
                            <?= $form->field($modelI, 'telephone_number')->textInput()->label('') ?>
                            <label class="form-label" for="typePasswordX">Номер телефона</label>
                        </div>

                        <?= Html::submitButton('Оформить', ['class' => 'btn btn-outline-light btn-lg px-5 mt-5', 'name' => 'order-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>