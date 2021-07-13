<?php
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\blogs\BlogPosts;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Теги блога',
        'content' => function($data){
            return $data->blogTag->name;
        }
    ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'template' => false,
        
    // ],
];   