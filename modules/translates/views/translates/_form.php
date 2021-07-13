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
        <div class="col-md-12 col-xs-12">
            <?= $form->field($model, 'table_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12 col-xs-12">
            <?= $form->field($model, 'field_value')->textarea(['rows' => 2]) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
