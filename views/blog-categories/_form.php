<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlogCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-categories-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"> 
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <?php foreach ($available_languages as $available_language) : ?>
                    <li class="nav-item <?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'active' : '' ?>">
                        <a class="nav-link"
                            id="home-tab-<?=$available_language->url?>"
                            data-toggle="tab"
                            href="#tab-page-<?=$available_language->url?>"
                            role="tab"
                            aria-controls="home"
                            aria-selected="false"
                            aria-expanded="<?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'true' : 'false' ?>"
                        >
                            <?=$available_language->name?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>


            <div class="tab-content" id="myTabContent">
                <?php foreach ($available_languages as $available_language) : ?>
                    <div class="tab-pane fade <?=($available_language->url == \app\modules\translates\models\Langs::MAIN_LANGUAGE) ? 'active in' : '' ?>" id="tab-page-<?=$available_language->url?>" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row"> 
                            <div class="col-md-12 col-xs-12">
                                <?= $form->field($model, 'tr_name['.$available_language->url.']')->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('name')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12 col-xs-6">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12 col-xs-6">
            <?= $form->field($model, 'status')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getStatus(),
                'options' => ['placeholder' => Yii::t('app','Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
