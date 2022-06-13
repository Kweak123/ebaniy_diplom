<?php

/** @var yii\web\View $this */

use yii\helpers\Html;


?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-xl-4 col-md-6 text-center">
            <div class="card card-inverse" style="background-color: #333; border-color: #333;">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 p-5">
                            <h2 class="card-title" style="color: #fff">Логин: <?= Yii::$app->user->identity->login ?></h2>
                            <p class="card-text" style="color: #fff"><strong>Роль: </strong> Пользователь </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>