<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\regions\models\DistrictsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="districts-index">
    <div id="ajaxCrudDatatableDistricts">
        <?=GridView::widget([
            'id'=>'crud-datatable-districts',
            'dataProvider' => $dataProvider,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=> ''
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'default',
                'heading' => Yii::t('app','Districts'),
                'after'=>'<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>