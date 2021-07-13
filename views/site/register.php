<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login_content">

    <!-- <p>Please fill out the following fields to login:</p> -->

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        // 'layout' => 'horizontal',
        'fieldConfig' => [
            // 'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            // 'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => $model->getAttributeLabel('username')])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            // 'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="clearfix"></div>

        <div>
            <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
            <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-link', 'name' => 'register-button']) ?>

            <a class="reset_pass" href="#">Lost your password?</a>
        </div>

        <div class="clearfix"></div>

        <div class="separator">
            <p class="change_link">New to site?
            <a href="#signup" class="to_register"> Create Account </a>
            </p>
            <div class="clearfix"></div>
            <br>
            <div>
            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
            </div>
        </div>
        
    <?php ActiveForm::end(); ?>
</section>