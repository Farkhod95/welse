<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BlogTagsRelations */
?>
<div class="blog-tags-relations-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'blog_id',
            'blog_tag_id',
        ],
    ]) ?>

</div>
