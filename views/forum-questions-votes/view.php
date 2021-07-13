<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestionsVotes */
?>
<div class="forum-questions-votes-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'forum_question_id',
            'forum_questions_comments_id',
            'up',
        ],
    ]) ?>

</div>
