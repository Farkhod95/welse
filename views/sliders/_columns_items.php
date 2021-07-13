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
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'slider_id',
    //     'width'=>'120px',
    //     'filter' => ArrayHelper::map(Sliders::find()->all(),'id','title'),
    //     'content' => function ($data) {
    //         return $data->slider_id? $data->slider->title:'';
    //     },
    // ], 
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'url',
    ],
    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => ' {leadView} {leadUpdate} {leadDelete}',
        'buttons'  => [
            'leadView' => function ($url, $model) {
                $url = Url::to(['slider-items/view', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['role'=>'modal-remote','title'=>Yii::t('app','View'), 'data-toggle'=>'tooltip']);
            },
            'leadUpdate' => function ($url, $model) {
                $url = Url::to(['slider-items/update', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip']);
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