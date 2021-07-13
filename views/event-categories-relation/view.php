<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EventCategoriesRelation */
?>
<div class="event-categories-relation-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'event_id',
            'event_category_id',
        ],
    ]) ?>

</div>
