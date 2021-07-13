<?php
use yii\helpers\Url;
use yii\helpers\Html;
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'slug',
    ],
    [
        'attribute' => 'status',
        'width'=>'120px',
        'filter' => array('1' => 'Актив' , '2' => 'Не Актив'),
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
    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => ' {leadView} {leadUpdate} {leadDelete}',
        'buttons'  => [
            'leadView' => function ($url, $model) {
                $url = Url::to(['events/index', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title'=>'Просмотр событий', 'data-toggle'=>'tooltip', 'data-pjax' => 0]);
            },
            'leadUpdate' => function ($url, $model) {
                $url = Url::to(['update', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['role'=>'modal-remote', 'title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip']);
            },
            'leadDelete' => function ($url, $model) {
                $url = Url::to(['slider-items/delete', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                    'role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>Yii::t('app','Are you sure?'),
                    'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')
                ]);
            },
        ]
    ],

];   