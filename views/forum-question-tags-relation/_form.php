<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestionTagsRelation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forum-question-tags-relation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'forum_question_id')->textInput() ?>

    <?= $form->field($model, 'forum_question_tag_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
