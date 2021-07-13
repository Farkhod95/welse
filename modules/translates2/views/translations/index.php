<?php
use  app\modules\translates\models\Langs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\editable\Editable;

$langs = Langs::find()->where(['id' => $idLangs])->one();

$this->title = Yii::t('app','Translations list');
$this->params['breadcrumbs'][] = ['label' => "Языки", 'url' => ['/translates/langs']];
$this->params['breadcrumbs'][] = $this->title;
$count = 0;
?>
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
                                    <h2><?=Yii::t('app','Translates')?></h2>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 20px">
                                 <div class="pull-right">
                                    <?=Html::a(Yii::t('app','Back'),['/translates/langs'],['class'=>'btn btn-warning',])?>
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
                                <th><?=Yii::t('app','Sources')?></th>
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
                                                        'placeholder'=>Yii::t('app','Enter notes'),
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