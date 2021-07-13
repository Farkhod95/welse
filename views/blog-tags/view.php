<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BlogTags */
?>
<div class="blog-tags-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'slug',
            'frequency',
            'name',
            'searching',
            'meta_title',
        ],
    ]) ?>

</div>
