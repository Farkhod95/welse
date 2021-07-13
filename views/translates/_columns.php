<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'table_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'language_code',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'field_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'field_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'field_value',
        'format'=>'html',   
        'contentOptions' => [
            'style'=>'max-width:150px; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'field_description',
    // ],
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