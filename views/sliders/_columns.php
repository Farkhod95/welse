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
            $data->image != null ? $path = '/uploads/slider/' . $data->image : $path = '/image/image-not-found.png';
            return Html::img($path, ['style' => 'width:70px; height:70px; border-radius: 25%',]);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'attribute'=>'status',
        'width'=>'50px',
        'format'=>'raw',
        'value'=>function($data){
            return '<label class="switch switch-small">
                    <input type="checkbox" '. (($data->status == 1)?' checked=""':'""').(($data->status==0)?' disabled=""':'""').'>
                    <span></span>
                    </a>
                </label>';
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