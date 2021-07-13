<?php
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

?>

<div class="lang-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'']) ?>
        </div>
        <br>
        <div class="col-md-6">
            <?= $form->field($model, 'url')->widget(\yii\widgets\MaskedInput::className(), ['mask' => 'aa','options'=>['placeholder'=>'ru']]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList($model->getStatus(), ['options'=>['0'=>['disabled'=>($model->default&& $model->id == 1)?true:false]]]); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
