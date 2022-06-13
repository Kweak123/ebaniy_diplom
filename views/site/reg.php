<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\RegForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


?>

<?php $form = ActiveForm::begin([
    'id' => 'reg-form',
    'enableAjaxValidation' => true,
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
        <div class="col-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card text-white" style="border-radius: 1rem; background-color: rgba(0,0,0,0.5)">
                <div class="card-body p-5 text-center">

                    <div>

                        <h2 class="fw-bold mb-2 text-uppercase" style="color: #ffffff !important;">Регистрация</h2>
                        <p class="text-white-50 " style="color: #ffffff !important;">Введите данные для регистрации</p>

                        <div class="d-flex">
                        <div class="form-outline form-white mr-5">
                            <?= $form->field($model, 'login')->textInput(['autofocus' => true])->label('') ?>
                            <label class="form-label" for="typeEmailX">Логин</label>
                        </div>

                        <div class="form-outline form-white">
                            <?= $form->field($model, 'email')->textInput()->label('') ?>
                            <label class="form-label" for="typeEmailX">Почта</label>
                        </div>
                        </div>

                        <div class="d-flex">
                        <div class="form-outline form-white mr-5">
                            <?= $form->field($model, 'password')->passwordInput()->label('') ?>
                            <label class="form-label" for="typeEmailX">Пароль</label>
                        </div>

                        <div class="form-outline form-white">
                            <?= $form->field($model, 'password_repeat')->passwordInput()->label('') ?>
                            <label class="form-label" for="typePasswordX">Повтор пароля</label>
                        </div>
                        </div>

                        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-outline-light btn-lg px-5 mt-5', 'name' => 'reg-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



