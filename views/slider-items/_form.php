<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
$model->image != null ? $path = '/uploads/sliderItem/' . $model->image : $path = '/image/image-not-found.png';
?>

<div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
            <h2><b><?= $model->isNewRecord ? 'Создать' : 'Изменить' ?></b></h2>
            <button type="submit" class="btn btn-link pull-right" onclick="window.location.href='/sliders/view/?id=<?= $model->isNewRecord ? $id : $model->slider_id ?>'" > <i class="fa fa-reply"> </i> <?=Yii::t('app','Back')?></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'encodeErrorSummary' => false, 'errorSummaryCssClass' => 'help-block',]); ?>
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
                                            <?= $form->field($model, 'tr_title['.$available_language->url.']')->textInput(['maxlength' => true,'placeholder' => $model->getAttributeLabel('title')]) ?>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-12 col-xs-12">
                                            <?= $form->field($model, 'tr_description['.$available_language->url.']')->widget(TinyMce::className(), [
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
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-12 col-xs-6">
                        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-6">
                        <div id="polls">
                            <?= Html::img($path, [
                                'style' => 'width:180px; height:180px; border-radius: 25%',
                            ]) ?>
                        </div>
                        <?= $form->field($model, 'filePhoto', ['inputOptions' =>['value' => $model->filePhoto]])->fileInput(['accept' => 'image/*', 'class' => "poster_image"]); ?>
                    </div>
                </div>

            
                <?php if (!Yii::$app->request->isAjax){ ?>
                    <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'width: 100%']) ?>
                    </div>
                <?php } ?>
                <!-- <?= $form->errorSummary($model) ?> -->
                <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
$this->registerJs(<<<JS
    var fileCollection = new Array();
    $(document).on('change', '.poster_image', function(e){
        var files = e.target.files;
        $.each(files, function(i, file){
            fileCollection.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                var template = '<img style="width:180px; height:180px;" src="'+e.target.result+'"> ';
                $('#polls').html('');
                $('#polls').append(template);
                $('#image_img').html('').append(template);
            };
        });
    });
JS
);
?>
