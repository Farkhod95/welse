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
        'label'=>'Тег форума',
        'content' => function($data){
            return $data->forumQuestionTag->name;
        }
    ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'template' => false,
        
    // ],
];   