<?php
use app\modules\translates\models\Langs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\editable\Editable;
use johnitvn\ajaxcrud\BulkButtonWidget;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$langs = Langs::find()->where(['id' => $idLangs])->one();

$this->title = "Список переводы";
$this->params['breadcrumbs'][] = ['label' => "Языки", 'url' => ['/langs']];
$this->params['breadcrumbs'][] = $this->title;
$count = 0;

CrudAsset::register($this);
?>
<?php Pjax::begin(['enablePushState' => false, 'id' => 'crud-datatable-pjax']); ?>
    <div class="panel panel-inverse">
        <div class="panel-heading"><?=Html::encode($this->title);?></div>
        <div class="">
            <div class="container-fluid container-fixed-lg m-t-20">
                <div class="panel-transparent">
                        <div class="panel-body no-padding">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pull-left">
                                        <h2>Переводы</h2>

                                        <?= Html::a(Yii::t('app','Create'), ['create' , 'id' => $idLangs], ['class' => 'btn btn-success' , 'role' => 'modal-remote']) ?>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 20px">
                                     <div class="pull-right">
                                        <?=Html::a('Назад',['/langs'],['class'=>'btn btn-warning',])?>
                                    </div>
                                </div>
                            </div>
                            <BR>
                            <div class="table-responsive">
                                <div class="input-group pull-left form-group">
                                    <input type="text" class="form-control" placeholder="Поиск..." id="myInput">
                                    <div class="input-group-btn">
                                      <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                      </button>
                                    </div>
                                </div>
                                <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Источники</th>
                                    <th>
                                        <?= $langs->url; ?> (<?=$langs->name?>)
                                    </th>

                                </tr>
                                </thead>
                                    <tbody id="myTable">
                                    <?php foreach ($sources as $source): $messages = $source->messages;?>
                                        <tr>
                                            <td>
                                                <?=$source->id?>
                                            </td>
                                            <td style="word-break:all;width:45%;">
                                                <?=$source->keyword?>
                                            </td>
                                            <?php foreach ($messages as $message): ?>
                                                <?php
                                                    $value_lang = $message->translation;
                                                    if($message->lang_id == $idLangs):
                                                ?>
                                                <td align="left">
                                                    <?php
                                                    $count = $count + 1;
                                                    $lang_id = $message->lang_id;
                                                    echo Editable::widget([
                                                        'name'=>'translation['.$lang_id.']['.$source->id.']',
                                                        'asPopover' => true,
                                                        'inputType' => Editable::INPUT_TEXTAREA,
                                                        'value' => $value_lang,
                                                        'header' => 'Name',
                                                        'size'=>'md',
                                                        'options' => ['class'=>'form-control',  'rows'=>5,
                                                            'placeholder'=>'Enter notes',
                                                        ]
                                                    ]);
                                                    ?>
                                                </td>
                                            <?php endif; endforeach;?>

                                        </tr>
                                    <?php endforeach;?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php Pjax::end(); ?>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php
$this->registerJs(<<<JS
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    })
JS
);
?>