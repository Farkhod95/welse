<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserRoles */
?>
<div class="user-roles-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'user_id',
                'value' => function ($data) {
                    return $data->user->fio;
                },
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'role_id',
                'value' => function ($data) {
                    return $data->role->name;
                },
            ],
        ],
    ]) ?>

</div>
