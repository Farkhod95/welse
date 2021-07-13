<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SliderItems */

?>
<div class="slider-items-create">
    <?= $this->render('_form', [
        'id' => $id,
        'model' => $model,
        'available_languages' => $available_languages
    ]) ?>
</div>
