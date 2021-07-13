<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\regions\models\Districts */
?>
<div class="districts-view">

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
                            'label' => $available_language->name,
                            'value' => function($data) use ($available_language){
                                return isset($data->tr_name[$available_language->url]) ? $data->tr_name[$available_language->url] : '';
                            }
                        ]
                    ],
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>

</div>
