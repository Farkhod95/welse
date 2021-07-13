<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Users;
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'content',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
        'filter' => ArrayHelper::map(Users::find()->all(),'id','fio'),
        'content' => function ($data) {
            return $data->user_id? $data->user->fio:'';
        },
    ],
    [
        'attribute' => 'status',
        'width'=>'140px',
        'filter' => array('1' => 'Активный', '2' => 'Закрыто' ),
        'format' => 'raw',
        'value' => function ($data) {
            if($data->status){
                return \yii\helpers\ArrayHelper::map([
                    ['id' => 1,
                        'title' => '<span class="label label-info">Активный</span>',],
                    ['id' => 2,
                        'title' => '<span class="label label-success">Закрыто</span>',],
                ], 'id', 'title')[$data->status];
            }
        } 
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'viewed',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view} {update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['title'=>Yii::t('app','View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   