<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

$bundle = yiister\gentelella\assets\Asset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login">
    <?php $this->beginBody() ?>
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <?= $content?>
                </div>
          </div>
        </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
