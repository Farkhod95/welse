<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app','Authorization');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login_content">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        // 'layout' => 'horizontal',
        'fieldConfig' => [
            // 'template' => "<div class=\"col-md-12\">{input}{error}</div>",
        ],
    ]); ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <p><?= Yii::t('app','Please fill out the following fields to login:')?></p>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => $model->getAttributeLabel('username')])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            // 'template' => "<div class=\"col-lg-offset-1 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-default', 'name' => 'login-button']) ?>
        <?= Html::a(Yii::t('app','Lost your password?'),['/site/reset-password'], ['class' => 'btn btn-link', 'name' => 'register-button']) ?>
        <div class="clearfix"></div>
        <div class="separator">
            <p class="change_link"><?=Yii::t('app','New to site?')?>
            <?= Html::a(Yii::t('app','Create Account'),['/site/register'], ['class' => 'btn-xs', 'name' => 'register-button']) ?>
            </p>
            <div class="clearfix"></div>
            <br>
            <div>
            <h1><i class="fa fa-shopping-cart"></i> Welse</h1>
            <p> <?=Yii::t('app','©2020 All Rights Reserved.')?> <?=Html::a(Yii::t('app','Privacy and Terms'),['/site/privacy'],['target'=>'_blank'])?></p>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</section>