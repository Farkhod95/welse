<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@bower/gentelella/';
    public $baseUrl = '@bower/gentelella';

    public $css = [
        'vendors/bootstrap/dist/css/bootstrap.min.css',
        'vendors/font-awesome/css/font-awesome.min.css',
        'vendors/nprogress/nprogress.css',
        'vendors/animate.css/animate.min.css',
        'build/css/custom.min.css',

    ];
    public $js = [
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
