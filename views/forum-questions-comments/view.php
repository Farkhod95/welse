<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ForumQuestionsComments */
?>
<div class="forum-questions-comments-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'forum_question_id',
            'comment_reply_id',
            'created_at',
            'content:ntext',
            'is_edited',
        ],
    ]) ?>

</div>
