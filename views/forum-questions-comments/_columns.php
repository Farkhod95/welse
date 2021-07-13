<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Users;
use app\models\ForumQuestions;
use app\models\UserRoles;

$userRoles = UserRoles::find()->Where(['role_id' => 5])->all();
$userArray = [];
foreach ($userRoles as $userRole){
    $userArray  [] = $userRole->user_id;
}
return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
        'filter' => ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio'),
        'content' => function ($data) {
            return $data->user_id? $data->user->fio:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'forum_question_id',
        'filter' => ArrayHelper::map(ForumQuestions::find()->all(),'id','title'),
        // 'content' => function ($data) {
        //     return $data->forum->title;
        // },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'comment_reply_id',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'content',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'is_edited',
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
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   