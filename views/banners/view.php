<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */
?>
<div class="banners-view">
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
                            [
                                'attribute' => 'type',
                                'width'=>'120px',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    if($data->type){
                                        return \yii\helpers\ArrayHelper::map([
                                            ['id' => 1,
                                                'title' => '<span class="label label-success">Актив</span>',],
                                            ['id' => 2,
                                                'title' => '<span class="label label-info">Не Актив</span>',],
                                        ], 'id', 'title')[$data->type];
                                    }
                                } 
                            ],
                            [
                                'class'=>'\kartik\grid\DataColumn',
                                'attribute'=>'url',
                            ],
                            
                            [
                                'attribute'=>'description',
                                'format'=>'html',  
                                'value' => function($data) use ($available_language){
                                    return isset($data->tr_description[$available_language->url]) ? $data->tr_description[$available_language->url] : '';
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
