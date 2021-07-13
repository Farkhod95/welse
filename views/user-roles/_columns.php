<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Roles;
use app\models\Users;
use app\models\UserRoles;

$userRoles = UserRoles::find()->Where(['!=', 'role_id', 5])->all();
$userArray = [];
foreach ($userRoles as $userRole){
    $userArray  [] = $userRole->user_id;
}
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
        'attribute'=>'user_id',
        'filter' => ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio'),
        'content' => function ($data) {
            return $data->user->fio;
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'role_id',
        'filter' => ArrayHelper::map(Roles::find()->where(['!=' ,'id', 5])->all(),'id','name'),
        'content' => function ($data) {
            return $data->role->name;
        },
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip', 'data-pjax' => 0],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   