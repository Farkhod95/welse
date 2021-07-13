<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\countries\models\countries */
/* @var $form yii\widgets\ActiveForm */
$this->title = $model->isNewRecord ? 'Создать' : 'Редактировать';
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Создать' : 'Редактировать';
?>

<div class="countries-form">

    <?php $form = ActiveForm::begin(); ?>
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
                <?= $form->field($model, 'tr_name['.$available_language->url.']')->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('name')])->label(false) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true])?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>
