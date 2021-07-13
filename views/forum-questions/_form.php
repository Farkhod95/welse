<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestions */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Вопрос форума';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="forum-questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row"> 
        <div class="col-md-4 col-xs-4   ">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-4">
            <?= $form->field($model, 'user_id')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getUsers(),
                'options' => ['placeholder' => Yii::t('app','Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-4 col-xs-4">
            <?= $form->field($model, 'status')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getStatus(),
                'options' => ['placeholder' => Yii::t('app','Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12">
            <?= $form->field($model, 'tags')->widget(Select2::classname(), [
                'data' => $model->getTagsList(),
                'options' => ['placeholder' => 'Выберите'],
                'pluginOptions' => [
                    'tags' => true,
                    'allowClear' => true,
                    'multiple' => true
                ],
            ])->label('Теги');?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12 col-xs-6">
            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
