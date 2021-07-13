<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SliderItems */
?>
<div class="slider-items-update">

    <?= $this->render('_form', [
        'model' => $model,
        'available_languages' => $available_languages
    ]) ?>

</div>
