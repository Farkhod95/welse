<?php

use yii\widgets\DetailView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Blogs */
$this->title = 'Блог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blogs-view">
<div class="panel panel-inverse documentation-index">
    <div class="panel-heading" style="background: #616A6B; color: #FDFEFE">
        <h4 class="panel-title">Блоги</h4>
        <button type="submit" class="btn btn-link pull-right" style="margin-top: -25px; color: #ffffff" onclick="window.location.href='/blogs'" > <i class="fa fa-reply"> </i> <?=Yii::t('app','Back')?></button>
    </div> 
    <div class="panel-body">
    <div class="row"> 
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <?php foreach ($available_languages as $available_language) : ?>
                    <li class="nav-item <?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'active' : '' ?>">
                        <a class="nav-link"
                        id="home-tab-<?=$available_language->url?>"
                        data-toggle="tab"
                        href="#tab-page-<?=$available_language->url?>"
                        role="tab"
                        aria-controls="home"
                        aria-selected="false"
                        aria-expanded="<?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'true' : 'false' ?>"
                        >
                            <?=$available_language->name?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="tab-content" id="myTabContent">
                <?php foreach ($available_languages as $available_language) : ?>
                    <div class="tab-pane fade <?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'active in' : '' ?>" id="tab-page-<?=$available_language->url?>" role="tabpanel" aria-labelledby="home-tab">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute'=>'title',
                                    'value' => function($data) use ($available_language){
                                        return isset($data->tr_title[$available_language->url]) ? $data->tr_title[$available_language->url] : '';
                                    }
                                ],
                                'slug',
                                [
                                    'class'=>'\kartik\grid\DataColumn',
                                    'attribute'=>'author_id',
                                    'value' => function ($data) {
                                        return $data->author_id? $data->author->fio:'';
                                    },
                                ],
                                [
                                    'class'=>'\kartik\grid\DataColumn',
                                    'attribute'=>'country_id',
                                    'value' => function ($data) {
                                        return $data->country_id? $data->country->name:'';
                                    },
                                ],
                                [
                                    'class'=>'\kartik\grid\DataColumn',
                                    'attribute'=>'region_id',
                                    'value' => function ($data) {
                                        return $data->region_id? $data->region->name:'';
                                    },
                                ],
                                [
                                    'class'=>'\kartik\grid\DataColumn',
                                    'attribute'=>'district_id',
                                    'value' => function ($data) {
                                        return $data->district_id? $data->district->name:'';
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
                                'created_at',
                                'updated_at',
                                'published_at',
                                'viewed',
                            ],
                        ]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-12 col-xs-12">

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
</div> 
</div> 
