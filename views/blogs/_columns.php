<?php
use yii\helpers\Url;
use app\models\Users;

use app\models\BlogCategories;
use app\modules\countries\models\Countries;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use yii\helpers\ArrayHelper;
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
        'attribute'=>'title',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'slug',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'category_id',
        'filter' => ArrayHelper::map(BlogCategories::find()->all(),'id','name'),
        'content' => function ($data) {
            return $data->category_id? $data->category->name:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'author_id',
        'filter' => ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio'),
        'content' => function ($data) {
            return $data->author_id? $data->author->fio:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'country_id',
        'filter' => ArrayHelper::map(Countries::find()->all(),'id','name'),
        'content' => function ($data) {
            return $data->country_id? $data->country->name:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'region_id',
        'filter' => ArrayHelper::map(Regions::find()->all(),'id','name'),
        'content' => function ($data) {
            return $data->region_id? $data->region->name:'';
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'district_id',
        'filter' => ArrayHelper::map(Districts::find()->all(),'id','name'),
        'content' => function ($data) {
            return $data->district_id? $data->district->name:'';
        },
    ],
    [
        'attribute' => 'status',
        'width'=>'140px',
        'filter' => array('1' => 'Черновик', '2' => 'Опубликовано' , '3' => 'Архивировано', '4' => 'Удалено'),
        'format' => 'raw',
        'value' => function ($data) {
            if($data->status){
                return \yii\helpers\ArrayHelper::map([
                    ['id' => 1,
                        'title' => '<span class="label label-info">Черновик</span>',],
                    ['id' => 2,
                        'title' => '<span class="label label-success">Опубликовано</span>',],
                    ['id' => 3,
                        'title' => '<span class="label label-warning">Архивировано</span>',],
                    ['id' => 4,
                        'title' => '<span class="label label-danger">Удалено</span>',],
                ], 'id', 'title')[$data->status];
            }
        } 
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
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app','Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')], 
    ],

];   