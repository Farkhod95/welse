<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */
?>
<div class="blogs-update">

    <?= $this->render('_form', [
        'model' => $model,
        'available_languages' => $available_languages
    ]) ?>

</div>
