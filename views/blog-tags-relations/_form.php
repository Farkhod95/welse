<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlogTagsRelations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-tags-relations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'blog_id')->textInput() ?>

    <?= $form->field($model, 'blog_tag_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
