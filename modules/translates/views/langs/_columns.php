<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [

    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
         'class'=>'\kartik\grid\DataColumn',
        'width' => '200px',
         'attribute'=>'name',
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'width' => '100px',
        'attribute'=>'url',
    ],
    [
        'contentOptions'=>['class'=>'text-center'],
        'headerOptions'=>['class'=>'text-center'],
        'attribute'=>'status',
        'width'=>'150px',
        'format'=>'raw',
        'value'=>function($data){
            return '<label class="switch switch-small">
                    <input type="checkbox"'. (($data->status == 1)?' checked=""':'""').(($data->default==2)?' disabled=""':'""').'value="'.$data->id.'" onchange="$.post(\'/translates/langs/change-values\',{id:'.$data->id.'},function(data){ });">
                    <span></span>
                    </a>
                </label>';
        },
    ],
    [
        'class'    => 'kartik\grid\ActionColumn',
        'template' => ' {update} {leadDelete} {messages}',
        'viewOptions'=>['role'=>'modal-remote','title'=> Yii::t('app','View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=> Yii::t('app','Update'), 'data-toggle'=>'tooltip', 'class' => 'btn btn-success btn-xs'],
        'header' => '',
        'width' => '12%',
        'buttons'  => [
            'messages' => function($url, $model){
                $url = Url::to(['/translations/index/', 'lang_id' => $model->id]);
                return Html::a('<span class="glyphicon glyphicon-book"></span>', $url, [
                    'class' => 'btn btn-info btn-xs',
                    'data-pjax'=>0,'title'=> Yii::t('app','Translates'),
                    'data-toggle'=>'tooltip'
                ]);
            },
            'leadDelete' => function ($url, $model) {
                if($model->default == 0){
                    $url = Url::to(['delete', 'id' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'class' => 'btn btn-warning btn-xs',
                        'role'=>'modal-remote','title'=> Yii::t('app','Delete'),
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-toggle'=>'tooltip',
                        'data-confirm-title'=> Yii::t('app','Are you sure?'),
                        'data-confirm-message'=> Yii::t('app','Are you sure want to delete this item'),
                    ]);
                }
            },
        ]
    ],

];