<?php
use  app\modules\translates\models\Langs;
use  app\modules\translates\models\Translates;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\editable\Editable;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView; 
use yii\bootstrap\Modal;

CrudAsset::register($this);

$this->title = Yii::t('app','Translations list');
$this->params['breadcrumbs'][] = ['label' => "Языки", 'url' => ['/translates/langs']];
$this->params['breadcrumbs'][] = $this->title;
$count = 0;
?>
<div class="panel panel-inverse documentation-index">
    <div class="panel-heading" style="background: #616A6B; color: #FDFEFE">
        <h4 class="panel-title">События Участники</h4>
    </div> 
    <div class="panel-body">
        <div id="ajaxCrudDatatable">
            <?=GridView::widget([
                'id'=>'crud1-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'toolbar'=> [
                ],          
                'striped' => true,
                'condensed' => true,
                'responsive' => true,          
                'panel' => [
                    'headingOptions' => ['style' => 'display: none;'],
                    'after'=>'',
                ]
            ])?>
        </div>
    </div>
</div>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>