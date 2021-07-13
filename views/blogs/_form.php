<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Blogs */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Блог';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blogs-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row"> 
        <div class="col-md-12 col-xs-6">
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
                                <?= $form->field($model, 'tr_title['.$available_language->url.']')->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('title')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div> 
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'category_id')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getCategories(),
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
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'status')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getStatus(),
                'options' => ['placeholder' => Yii::t('app','Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
        <div class="col-md-6 col-xs-6">
            <?= $form->field($model, 'author_id')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getAuthors(),
                'options' => ['placeholder' => Yii::t('app','Select')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-4 col-xs-4">
            <?= $form->field($model, 'country_id')->label()->widget(\kartik\select2\Select2::classname(), [
                    'data' => $model->getCountries(),
                    'options' => [
                        'placeholder' => Yii::t('app','Select'),
                        'onchange'=>'
                            $.post( "/blogs/regions?id='.'"+$(this).val(), function( data ){
                                $( "select#region_id" ).html( data);
                                alter(data);
                            });' 
                        ],
                    'pluginOptions' => [ 
                        'allowClear' => true
                    ],
                ]); ?> 
        </div>
        <div class="col-md-4 col-xs-4">
            <?= $form->field($model, 'region_id')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getRegions($model->country_id),
                'options' => [
                    'placeholder' => Yii::t('app','Select'),
                    'id' => 'region_id',
                    'onchange'=>'
                        $.post( "/blogs/districts?id='.'"+$(this).val(), function( data ){
                            $( "select#district_id" ).html( data);
                        });' 
                    ],
                    
                'pluginOptions' => [ 
                    'allowClear' => true
                ],
            ]); ?> 
        </div>
        <div class="col-md-4 col-xs-4">
            <?= $form->field($model, 'district_id')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getDistricts($model->region_id),
                'options' => [
                    'placeholder' => Yii::t('app','Select'),
                    'id' => 'district_id',
                    ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
