<?php
use yii\helpers\Url;
use yii\helpers\Html;
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
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'language_code',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'field_id',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'field_name',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'field_value',
        'format'=>'html',   
        'contentOptions' => [
            'style'=>'max-width:150px; min-height:100px; overflow: auto; word-wrap: break-word;'
        ],
    ],
    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => ' {leadUpdate} {leadDelete}',
        'buttons'  => [
            'leadUpdate' => function ($url, $model) {
                $url = Url::to(['/translates/translates/update', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip']);
            },
            'leadDelete' => function ($url, $model) {
                $url = Url::to(['/translates/translates/delete', 'id' => $model->id]);
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