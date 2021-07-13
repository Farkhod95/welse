<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sliders */

?>
<div class="sliders-create">
    <?= $this->render('_form', [
        'model' => $model,
        'available_languages' => $available_languages
    ]) ?>
</div>
