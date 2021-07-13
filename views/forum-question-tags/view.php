<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestionTags */
?>
<div class="forum-question-tags-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'slug',
        ],
    ]) ?>

</div>
