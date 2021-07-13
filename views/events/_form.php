<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\Blogs */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Событие';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
            <h2><b><?= $model->isNewRecord ? 'Создать' : 'Изменить' ?></b></h2>
            <button type="submit" class="btn btn-link pull-right" onclick="window.location.href='/events/index?id=<?=  $model->isNewRecord ? $id : $model->category_id ?>'" > <i class="fa fa-reply"> </i> <?=Yii::t('app','Back')?></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(); ?>
                    <div class="row"> 
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'members_count')->textInput(['maxlength' => true, 'type' => 'number']) ?>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'members_count_limit')->textInput(['maxlength' => true, 'type' => 'number']) ?>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'status')->label()->widget(\kartik\select2\Select2::classname(), [
                                'data' => $model->getStatus(),
                                'options' => ['placeholder' => Yii::t('app','Select')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'author_id')->label()->widget(\kartik\select2\Select2::classname(), [
                                'data' => $model->getAuthors(),
                                'options' => ['placeholder' => Yii::t('app','Select')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'started_date')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => Yii::t('app','Select date'), 'value' => date('d.m.Y')],
                                'removeButton' => false,
                                'pluginOptions' => [
                                    'autoclose'=>true, 
                                    'format' => 'dd.mm.yyyy',
                                ]
                            ]);
                            ?>  
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?= $form->field($model, 'finished_time')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => Yii::t('app','Select date'), 'value' => date('d.m.Y')],
                                'removeButton' => false,
                                'pluginOptions' => [
                                    'autoclose'=>true, 
                                    'format' => 'dd.mm.yyyy',
                                ]
                            ]);
                            ?> 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-4 col-xs-4">
                            <?= $form->field($model, 'country_id')->label()->widget(\kartik\select2\Select2::classname(), [
                                    'data' => $model->getCountries(),
                                    'options' => [
                                        'placeholder' => Yii::t('app','Select'),
                                        'onchange'=>'
                                            $.post( "/events/regions?id='.'"+$(this).val(), function( data ){
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
                                        $.post( "/events/districts?id='.'"+$(this).val(), function( data ){
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
                    <div class="row"> 
                        <div class="col-md-12 col-xs-6">
                            <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12 col-xs-12">
                            <?= $form->field($model, 'description')->widget(TinyMce::className(), [
                                'options' => ['rows' => 10],
                                'language' => 'ru',
                                'clientOptions' => [
                                    'height' => '300',
                                    'plugins' => [
                                        'advlist autolink lists link charmap hr preview pagebreak',
                                        'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                                        'save insertdatetime media table contextmenu template paste image responsivefilemanager filemanager',
                                    ],
                                    'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager link image media',
                                    'external_filemanager_path' => '/plugins/responsivefilemanager/filemanager2/',
                                    'filemanager_title' => 'Responsive Filemanager',
                                    'external_plugins' => [
                                        //Иконка/кнопка загрузки файла в диалоге вставки изображения.
                                        'filemanager' => '/plugins/responsivefilemanager/filemanager/plugin.min.js',
                                        //Иконка/кнопка загрузки файла в панеле иснструментов.
                                        'responsivefilemanager' => '/plugins/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
                                    ],
                                    'relative_urls' => false,
                                ]
                            ])?>
                        </div>
                    </div>
                
                    <?php if (!Yii::$app->request->isAjax){ ?>
                        <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'width: 100%']) ?>
                        </div>
                    <?php } ?>

                <?php ActiveForm::end(); ?>
    
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
