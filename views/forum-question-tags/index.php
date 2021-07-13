<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Теги вопросов форума';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="panel panel-inverse documentation-index">
    <div class="panel-heading" style="background: #616A6B; color: #FDFEFE">
        <h4 class="panel-title">Теги вопросов форума</h4>
    </div> 
    <div class="panel-body">
        <div id="ajaxCrudDatatable">
            <?=GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        '{export}'.
                        Html::a('Создать <i class="glyphicon glyphicon-plus"></i>', ['create'],
                        ['role'=>'modal-remote','title'=> 'Создать', 'class'=>'btn btn-success']),
                        // '{toggleData}'.
                        // '{export}'
                    ],
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
