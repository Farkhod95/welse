<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Translates */
?>
<div class="translates-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'table_name',
            'language_code',
            'field_id',
            'field_name',
            [
                'attribute'=>'field_value',
                'format'=>'html',   
                'contentOptions' => [
                    'style'=>'max-width:150px; min-height:100px; overflow: auto; word-wrap: break-word;'
                ],
            ],
            [
                'attribute'=>'field_description',
                'format'=>'html',   
                'contentOptions' => [
                    'style'=>'max-width:150px; min-height:100px; overflow: auto; word-wrap: break-word;'
                ],
            ],
        ],
    ]) ?>

</div>
