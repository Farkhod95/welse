<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\Html;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
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
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'key',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Область ',
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'width' => '100px',
        'content' => function($data){
            return '<center>' . Html::a('Область  <i class="glyphicon glyphicon-share-alt"></i>',
                    ['/regions', 'id' => $data->id],
                    ['title'=> Yii::t('app','Go to the regions list'), 'class'=>'btn btn-info', 'data-pjax' => 0]) . '</center>';
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
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