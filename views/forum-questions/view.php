<?php

use yii\widgets\DetailView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestions */
$this->title = 'Вопрос форума';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogs-view">
<div class="panel panel-inverse documentation-index">
    <div class="panel-heading" style="background: #616A6B; color: #FDFEFE">
        <h4 class="panel-title">Блоги</h4>
        <button type="submit" class="btn btn-link pull-right" style="margin-top: -25px; color: #ffffff" onclick="window.location.href='/forum-questions'" > <i class="fa fa-reply"> </i> <?=Yii::t('app','Back')?></button>
    </div> 
    <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'user_id',
                'value' => function ($data) {
                    return $data->user_id? $data->user->fio:'';
                },
            ],
            [
                'attribute' => 'status',
                'width'=>'140px',
                'format' => 'raw',
                'value' => function ($data) {
                    if($data->status){
                        return \yii\helpers\ArrayHelper::map([
                            ['id' => 1,
                                'title' => '<span class="label label-info">Активный</span>',],
                            ['id' => 2,
                                'title' => '<span class="label label-success">Закрыто</span>',],
                        ], 'id', 'title')[$data->status];
                    }
                } 
            ],
            'updated_at',
            'created_at',
            'viewed',
            [
                'attribute'=>'content',
                'format'=>'html',   
                'contentOptions' => [
                    'style'=>'max-width:150px; min-height:100px; overflow: auto; word-wrap: break-word;'
                ],
            ],
        ],
    ]) ?>
    <?=GridView::widget([
        'id'=>'tags-datatable',
        'dataProvider' => $tagsDataProvider,
        //'filterModel' => $searchShops,
        'pjax'=>true,
        'panelBeforeTemplate' => false,
        'columns' => require(__DIR__.'/_columns_tegs.php'),
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'responsiveWrap' => false,
        'panel' => false
    ])?>
</div>
</div> 
</div> 
