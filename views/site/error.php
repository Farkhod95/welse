<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app','Not Found (#404)');
?>
<div class="">
  <div class="row">
    <div class="col-md-12">
      <div class="col-middle">
        <div class="text-center text-center">
          <h1 class="error-number">404</h1>
          <h2><?= Yii::t('app','Sorry but we couldn\'t find this page')?></h2>
          <p><?= Yii::t('app','This page you are looking for does not exist')?>
          </p>
          <button type="button" class="btn btn-success" onclick="window.location.href='/'" > <?= Yii::t('app','Back home') ?></button>
        </div>
      </div>
    </div>
  </div>
</div>
