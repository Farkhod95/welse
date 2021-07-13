<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserBlogs */
?>
<div class="user-blogs-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'user_id',
                'value' => function ($data) {
                    return $data->user_id? $data->user->fio:'';
                },
            ],
            'author_username',
            'author_password_hash',
        ],
    ]) ?>

</div>
