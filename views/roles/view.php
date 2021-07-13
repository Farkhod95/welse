<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */
?>
<div class="roles-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'key',
        ],
    ]) ?>

</div>
