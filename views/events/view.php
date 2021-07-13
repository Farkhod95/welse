<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
/* @var $this yii\web\View */
/* @var $model app\models\Events */
$this->title = 'Событие';
CrudAsset::register($this);
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
            <h2><b> Событие: <?= $model->title ?></b></h2> 
            <button type="submit" class="btn btn-link pull-right" onclick="window.location.href='/events/index?id=<?= $model->id ?> '" > <i class="fa fa-reply"> </i> <?=Yii::t('app','Back')?></button>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <div class="col-md-12 col-sm-12 ">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Основная информация</b> </a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>События Участники</b> </a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                        <!-- start recent activity -->
                        <table class="data table table-striped no-margin">
                            <tbody>
                            <tr>
                                <td><b><?= Yii::t('app', 'Заголовок') ?>:</b></td>
                                <td><?= $model->title?$model->title :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Url') ?>:</b> </td>
                                <td><?= $model->url?$model->url :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Страна') ?>:</b> </td>
                                <td><?= $model->country_id?$model->country->name :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Область') ?>:</b> </td>
                                <td><?= $model->region_id?$model->region->name :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Район') ?>:</b> </td>
                                <td><?= $model->district_id ?$model->district->name :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Количество участников') ?>:</b></td>
                                <td><?= $model->members_count?$model->members_count :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Предел количества участников') ?>:</b> </td>
                                <td><?= $model->members_count_limit?$model->members_count_limit :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Дата начала') ?>:</b> </td>
                                <td><?= $model->started_date?Yii::$app->formatter->asDate($model->started_date, 'php:d.m.Y') :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Время окончания') ?>:</b> </td>
                                <td><?= $model->finished_time? Yii::$app->formatter->asDate($model->finished_time, 'php:d.m.Y') :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Расположение X') ?>:</b> </td>
                                <td><?= $model->location_x?$model->location_x :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Расположение Y') ?>:</b> </td>
                                <td><?= $model->location_y?$model->location_y :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Статус') ?>:</b> </td>
                                <td><?= $model->status? $model->getStatusView($model->status) :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Адрес') ?>:</b> </td>
                                <td><?= $model->address?$model->address :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Описание') ?>:</b> </td>
                                <td><?= $model->description?$model->description :'<i style="color:#d9534f">не задано</i>'?></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- end recent activity -->

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab_content2" aria-labelledby="home-tab">

                        <div class="panel-body">
                            <div id="ajaxCrudDatatable">
                                <?=GridView::widget([
                                    'id'=>'crud1-datatable',
                                    'dataProvider' => $dataProvider,
                                    // 'filterModel' => $searchModel,
                                    'pjax'=>true,
                                    'columns' => require(__DIR__.'/_columns_member.php'),
                                    'toolbar'=> [
                                        ['content'=>
                                            '{export}'.
                                            Html::a('Создать <i class="glyphicon glyphicon-plus"></i>', ['/event-members/create'],
                                            ['role'=>'modal-remote','title'=> 'Создать', 'class'=>'btn btn-success']),
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
            </div>
        </div>
        </div>
    </div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>