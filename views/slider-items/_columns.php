<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Sliders;
use yii\helpers\ArrayHelper;
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
            $data->image != null ? $path = '/uploads/sliderItem/' . $data->image : $path = '/image/image-not-found.png';
            return Html::img($path, ['style' => 'width:70px; height:70px; border-radius: 25%',]);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'slider_id',
        'width'=>'120px',
        'filter' => ArrayHelper::map(Sliders::find()->all(),'id','title'),
        'content' => function ($data) {
            return $data->slider_id? $data->slider->title:'';
        },
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