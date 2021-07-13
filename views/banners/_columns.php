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
        'attribute'=>'image',
        'width' => '100px',
        'content' => function($data){
            $data->image != null ? $path = '/uploads/banner/' . $data->image : $path = '/image/image-not-found.png';
            return Html::img($path, ['style' => 'width:70px; height:70px; border-radius: 25%',]);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'attribute' => 'type',
        'width'=>'120px',
        'filter' => array('1' => 'Актив' , '2' => 'Не Актив'),
        'format' => 'raw',
        'value' => function ($data) {
            if($data->type){
                return \yii\helpers\ArrayHelper::map([
                    ['id' => 1,
                        'title' => '<span class="label label-success">Актив</span>',],
                    ['id' => 2,
                        'title' => '<span class="label label-info">Не Актив</span>',],
                ], 'id', 'title')[$data->type];
            }
        } 
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'url',
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
        'updateOptions'=>['title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   