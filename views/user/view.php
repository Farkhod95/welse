<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fio',
            'username',
            'password_hash',
            'role',
            'created_at',
            'updated_at',
            'phone',
            'access_token',
            'auth_key',
            'avatar',
        ],
    ]) ?>

</div>
