<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\HelpsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Languages');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<div class="x_panel">
    <div class="x_title">
        <h2><?= Yii::t('app','Languages')?></h2>
        <ul class="nav navbar-right panel_toolbox">
            <?= Html::a(Yii::t('app','Add'),['/langs/langs/create'],['class' => 'btn btn-primary', 'role' => 'modal-remote']) ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div id="ajaxCrudDatatable">
            <?=GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'pager' => [
                    'firstPageLabel' => 'Первый',
                    'lastPageLabel'  => 'Последный'
                ],
                'responsiveWrap' => false,
                'panelBeforeTemplate' => false,
                'panel' => [
                    'headingOptions' => ['style' => 'display: none;'],
                    'after'=>
                        '<div class="clearfix"></div>',
                ],
            ])?>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
