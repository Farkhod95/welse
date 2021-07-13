<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */
?>
<div class="row"> 
                    <div class="col-md-12 col-xs-12">
                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <?php foreach ($available_languages as $available_language) : ?>
                                <li class="nav-item <?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'active' : '' ?>">
                                    <a class="nav-link"
                                    id="home-tab-<?=$available_language->url?>"
                                    data-toggle="tab"
                                    href="#tab12-page-<?=$available_language->url?>"
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
                                <div class="tab-pane fade <?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'active in' : '' ?>" id="tab12-page-<?=$available_language->url?>" role="tabpanel" aria-labelledby="home-tab">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'attribute'=>'title',
                                                'value' => function($data) use ($available_language){
                                                    return isset($data->tr_title[$available_language->url]) ? $data->tr_title[$available_language->url] : '';
                                                }
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
