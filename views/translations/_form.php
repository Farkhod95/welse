<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Translates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="translates-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"> 
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'translation')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
