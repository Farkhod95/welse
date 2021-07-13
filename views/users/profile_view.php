<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
$this->title = Yii::t('app','Profile') ;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
            <h2><b> <?= Yii::t('app','Profile') ?>: <?= $user_info->fio  ?></b></h2> 
            <button type="submit" class="btn btn-link pull-right" onclick="window.location.href='/'" > <i class="fa fa-reply"> </i> <?= Yii::t('app','Back') ?></button>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <div class="col-md-3 col-sm-3  profile_left">
                <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <?= Html::img($user_info->getImage(),['alt' => Yii::t('app','User Avatar'), 'class' => 'img-responsive avatar-view','style' => 'width: 100%'])?>
                </div>
                </div>
                <h3><?= $user_info->fio  ?></h3>

                <ul class="list-unstyled user_data">
                <li>
                    <i class="fa fa-map-marker user-profile-icon"> </i> <?= $user_info->country_id ? $user_info->country->name. ', '. $user_info->region->name. ', '.$user_info->district->name : '<i style="color:#d9534f">не задано</i>'?>
                </li>
                <li class="m-top-xs">
                    <i class="fa fa-envelope-o"></i>
                    <a href=""><?= $user_info->email? $user_info->email : '<i style="color:#d9534f">не задано</i>' ?></a>
                </li>
                </ul>
                
                <a class="btn btn-success" href="<?= Url::toRoute(['/users/update-admin-profile', 'id' => $user_info->id])?>"><i class="fa fa-edit m-right-xs"> </i> <?= Yii::t('app','Edit Profile') ?></a>
                <br />
            </div>
            <div class="col-md-9 col-sm-9 ">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Основная информация</b> </a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                        <!-- start recent activity -->
                        <table class="data table table-striped no-margin">
                            <tbody>
                            <tr>
                                <td><b><?= Yii::t('app', 'Fio') ?>:</b></td>
                                <td><?= $user_info->fio  ?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Birthday') ?>:</b> </td>
                                <td><?= Yii::$app->formatter->asDate($user_info->birthday, 'php:d.m.Y') ?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Email') ?>:</b></td>
                                <td><?= $user_info->email ?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Phone') ?>:</b> </td>
                                <td><?= $user_info->phone ?></td>
                            </tr>
                            <tr>
                                <td><b><?= Yii::t('app', 'Username') ?>:</b> </td>
                                <td><?= $user_info->username ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- end recent activity -->

                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
