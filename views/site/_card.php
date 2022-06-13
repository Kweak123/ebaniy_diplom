<?php

use yii\bootstrap4\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;

/* @var $model app\models\Services */

?>


<div class="col-lg-4 col-md-6 col-sm-12 tm-catalog-item">
    <div class="position-relative tm-thumbnail-container">
        <img src="/web/images/photo<?=$model->id?>.jpg" alt="Image" class="img-fluid tm-catalog-item-img" ">
    </div>
    <div class="p-4 tm-bg-gray" style="height: 22rem !important;">
        <h3 class=" mb-3 tm-catalog-item-title text-center"><?= Html::encode($model->name) ?></h3>
        <p class="tm-catalog-item-text"><?= HtmlPurifier::process($model->description) ?></p>
    </div>
    <?=Html::a('<button class="buyButtonVA" type="button">Оформить</button>', "site/issuedorder?service={$model->id}", ['class' => 'buyButton'])?>
</div>

