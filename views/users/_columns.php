<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'avatar',
        'width' => '100px',
        'content' => function($data){
            $data->avatar != null ? $path = '/uploads/avatar/' . $data->avatar : $path = '/image/image-not-found.png';
            return Html::img($path, ['style' => 'width:80px; height:80px; border-radius: 25%',]);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fio',
        'width'=>'120px',
        'content' => function ($data) {
            return $data->fio;
        },
    ], 
    [
        'class'=>'\kartik\grid\DataColumn',
        'width'=>'120px',
        'attribute'=>'birthday',
        'content' => function ($data) {
            return \Yii::$app->formatter->asDate($data->birthday, 'php:d.m.Y');
        },
    ], 
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'phone',
        'width'=>'120px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
        'width'=>'200px',
    ],
    [
        'attribute' => 'status',
        'width'=>'120px',
        'filter' => array('1' => 'Актив' , '2' => 'Не Актив', '3' => 'Заблокировано', '4' => 'Удалено'),
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
        'class'=>'\kartik\grid\DataColumn',
        'width'=>'120px',
        'attribute'=>'last_seen',
        'content' => function ($data) {
            $last_seen_minute = \Yii::$app->formatter->asDate($data->last_seen, 'php:i');
            $now_date__minute = date('i');
            if($last_seen_minute==$now_date__minute){
                $status = '<span style="color:green"><b>Онлайн</b></span>';
            }else{
                $status = '<span style="color:#f59c1a"><b>Не в сети</b></span>';
            }
            return $status;
        },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view} {update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   