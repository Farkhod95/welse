<?php

use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Banners */
CrudAsset::register($this);
?>
<div class="banners-view">
<div class="row"> 
    <div class="col-md-12 col-xs-12">
    <div class="panel panel-inverse documentation-index">
            <div class="panel-heading" style="background: #616A6B; color: #FDFEFE">
                <h4 class="panel-title"> Слайдер</h4>
                <button type="submit" class="btn btn-link pull-right" style="margin-top: -25px; color: #ffffff" onclick="window.location.href='/sliders'" > <i class="fa fa-reply"> </i> <?=Yii::t('app','Back')?></button>
            </div> 
            <div class="panel-body">
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
                                        'headerOptions'=>['class'=>'text-center'],
                                        'attribute'=>'status',
                                        'width'=>'50px',
                                        'format'=>'raw',
                                        'value'=>function($data){
                                            return '<label class="switch switch-small">
                                                    <input type="checkbox" '. (($data->status == 1)?' checked=""':'""').(($data->status==0)?' disabled=""':'""').'>
                                                    <span></span>
                                                    </a>
                                                </label>';
                                        },
                                    ],
                                    'url:url',
                                    
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
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-inverse documentation-index">
            <div class="panel-heading" style="background: #616A6B; color: #FDFEFE">
                <h4 class="panel-title"> Элемент слайдера</h4>
            </div> 
            <div class="panel-body">
                <div id="ajaxCrudDatatable">
                    <?=GridView::widget([
                        'id'=>'crud-datatable',
                        'dataProvider' => $dataSlidersItems,
                        'filterModel' => $searchSlidersItems,
                        'pjax'=>true,
                        'columns' => require(__DIR__.'/_columns_items.php'),
                        'toolbar'=> [
                            ['content'=>
                                '{export}'.
                                Html::a('Создать <i class="glyphicon glyphicon-plus"></i>', ['slider-items/create', 'id' => $model->id],
                                ['title'=> 'Создать', 'class'=>'btn btn-success', 'data-pjax' => 0]),
                                // '{toggleData}'.
                                // '{export}'
                            ],
                        ],          
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,          
                        'panel' => [
                            'headingOptions' => ['style' => 'display: none;'],
                            'after'=>'',
                        ]
                    ])?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>