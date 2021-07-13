<?php
use yii\helpers\Url;
use app\models\Users;
use app\modules\countries\models\Countries;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use yii\helpers\ArrayHelper;
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
        'attribute'=>'author_id',
        'filter' => ArrayHelper::map(Users::find()->all(),'id','fio'),
        'content' => function ($data) {
            return $data->author_id? $data->author->fio:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'members_count',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'width'=>'120px',
        'attribute'=>'started_date',
        'content' => function ($data) {
            return \Yii::$app->formatter->asDate($data->started_date, 'php:d.m.Y');
        },
    ], 
    [
        'class'=>'\kartik\grid\DataColumn',
        'width'=>'150px',
        'attribute'=>'finished_time',
        'content' => function ($data) {
            return \Yii::$app->formatter->asDate($data->finished_time, 'php:d.m.Y');
        },
    ], 
    [
        'attribute' => 'status',
        'width'=>'140px',
        'filter' => array('1' => 'Черновик', '2' => 'Опубликовано' , '3' => 'Архивировано', '4' => 'Удалено'),
        'format' => 'raw',
        'value' => function ($data) {
            if($data->status){
                return \yii\helpers\ArrayHelper::map([
                    ['id' => 1,
                        'title' => '<span class="label label-info">Черновик</span>',],
                    ['id' => 2,
                        'title' => '<span class="label label-success">Опубликовано</span>',],
                    ['id' => 3,
                        'title' => '<span class="label label-warning">Архивировано</span>',],
                    ['id' => 4,
                        'title' => '<span class="label label-danger">Удалено</span>',],
                ], 'id', 'title')[$data->status];
            }
        } 
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
        'updateOptions'=>['title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   