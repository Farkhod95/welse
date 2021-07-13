<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EventMembers */
?>
<div class="event-members-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'event_id',
            'user_id',
            'is_organizer',
        ],
    ]) ?>

</div>
