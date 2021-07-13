<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\UserRoles;

$userRoles = UserRoles::find()->Where(['role_id' => 5])->all();
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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
        'filter' => ArrayHelper::map(Users::find()->where(['id'=>$userArray])->all(), 'id', 'fio'),
        'content' => function ($data) {
            return $data->user_id? $data->user->fio:'';
        },
    ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'attribute'=>'is_organizer',
        'width'=>'150px',
        'format'=>'raw',
        'value'=>function($data){
            return '<label class="switch switch-small">
                    <input type="checkbox" '. (($data->is_organizer == 1)?' checked=""':'""').(($data->is_organizer==0)?' disabled=""':'""').'>
                    <span></span>
                    </a>
                </label>';
        },
    ],
    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => ' {leadUpdate} {leadDelete}',
        'buttons'  => [
            'leadUpdate' => function ($url, $model) {
                $url = Url::to(['event-members/update', 'id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['role'=>'modal-remote', 'title'=>Yii::t('app','Update'), 'data-toggle'=>'tooltip']);
            },
            'leadDelete' => function ($url, $model) {
                $url = Url::to(['event-members/delete', 'id' => $model->id]);
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