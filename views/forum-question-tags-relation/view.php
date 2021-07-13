<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestionTagsRelation */
?>
<div class="forum-question-tags-relation-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'forum_question_id',
            'forum_question_tag_id',
        ],
    ]) ?>

</div>
