<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BlogCategories */
?>
<div class="blog-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
        'available_languages' => $available_languages
    ]) ?>

</div>
