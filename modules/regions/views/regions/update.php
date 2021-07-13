<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\Regions */
?>
<div class="regions-update">

    <?= $this->render('_form', [
        'model' => $model,
        'available_languages' => $available_languages
    ]) ?>

</div>
