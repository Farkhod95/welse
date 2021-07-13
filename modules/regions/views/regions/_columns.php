<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

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
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        // uncomment below and comment detail if you need to render via ajax
        // 'detailUrl' => Url::to(['/site/book-details']),
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('../districts/index', ['dataProvider' => $model->getDistrictDataProvider()]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'key',
        'width'=>'100px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'sub_category',
        'header' => Yii::t('app','Districts'),
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'width' => '100px',
        'content' => function($data){
            return '<center>' . Html::a(Yii::t('app','Add'),
                    ['/regions/districts/create', 'id' => $data->id],
                    ['role'=>'modal-remote','title'=> Yii::t('app','Add'), 'class'=>'btn btn-warning']) . '</center>';
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
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item')],
    ],

];