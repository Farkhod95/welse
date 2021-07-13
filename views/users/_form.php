<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
$model->avatar != null ? $path = '/uploads/avatar/' . $model->avatar : $path = '/image/image-not-found.png';
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
                <?= $form->field($model, 'status')->label()->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getStatus(),
                'options' => [
                    'placeholder' => Yii::t('app','Select'),
                    'id' => 'type',
                    ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
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
                            $.post( "/users/regions?id='.'"+$(this).val(), function( data ){
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
                        $.post( "/users/districts?id='.'"+$(this).val(), function( data ){
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
        <div class="col-md-3 col-xs-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3 col-xs-3">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => "+\9\98##-###-##-##",'options' => ['placeholder' => '+99800-000-00-00','class'=>'form-control',]]) ?> 
        </div>
        <div class="col-md-3 col-xs-3">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3 col-xs-3">
            <?= $model->isNewRecord ? $form->field($model, 'password')->textInput(['maxlength' => true]) : $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-6">
            <div id="polls">
                <?= Html::img($path, [
                    'style' => 'width:180px; height:180px; border-radius: 25%',
                ]) ?>
            </div>
            <?= $form->field($model, 'file', ['inputOptions' =>['value' => $model->file]])->fileInput(['accept' => 'image/*', 'class' => "poster_image"]); ?>
        </div>
    </div>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
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