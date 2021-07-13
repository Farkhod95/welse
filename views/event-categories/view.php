<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EventCategories */
?>
<div class="event-categories-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'slug',
            [
                'attribute' => 'status',
                'width'=>'120px',
                'format' => 'raw',
                'value' => function ($data) {
                    if($data->status){
                        return \yii\helpers\ArrayHelper::map([
                            ['id' => 1,
                                'title' => '<span class="label label-success">Актив</span>',],
                            ['id' => 2,
                                'title' => '<span class="label label-info">Не Актив</span>',],
                        ], 'id', 'title')[$data->status];
                    }
                } 
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
