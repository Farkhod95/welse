<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
?>
<div class="users-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'fio',
                'width'=>'120px',
                'value' => function ($data) {
                    return $data->fio;
                },
            ], 
            'username',
            'email',
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
                            ['id' => 3,
                                'title' => '<span class="label label-warning">Заблокировано</span>',],
                            ['id' => 4,
                                'title' => '<span class="label label-danger">Удалено</span>',],
                        ], 'id', 'title')[$data->status];
                    }
                } 
            ],
            [
                'attribute' => 'birthday',
                'value' => function ($data) {
                 if($data->birthday != null )  return \Yii::$app->formatter->asDate($data->birthday, 'php:d.m.Y');
                },
            ],            
            'phone',
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'country_id',
                'value' => function ($data) {
                    return $data->country_id? $data->country->name:'';
                },
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'region_id',
                'value' => function ($data) {
                    return $data->region_id? $data->region->name:'';
                },
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'district_id',
                'value' => function ($data) {
                    return $data->district_id? $data->district->name:'';
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                 if($data->created_at != null )  return \Yii::$app->formatter->asDate($data->created_at, 'php:d.m.Y');
                },
            ],  
            [
                'attribute' => 'updated_at',
                'value' => function ($data) {
                 if($data->updated_at != null )  return \Yii::$app->formatter->asDate($data->updated_at, 'php:d.m.Y');
                },
            ],
        ],
    ]) ?>

</div>
