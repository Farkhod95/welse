<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventMembers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-members-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"> 
                        
        <div class="col-md-12 col-xs-12">
            <?= $form->field($model, 'user_id')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getUsers(),
                'options' => ['placeholder' => Yii::t('app','Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'is_organizer')->checkbox(); ?>
        </div>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
