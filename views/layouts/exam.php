<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

$bundle = yiister\gentelella\assets\Asset::register($this);
$user = Yii::$app->user->identity;

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script> -->
    <script id="MathJax-script" src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/mml-chtml.js"></script>
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-12">
            <!-- page content -->
            <?= $content ?>
            <!-- /page content -->
        </div>
    </div>
</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
