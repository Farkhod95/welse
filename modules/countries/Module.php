<?php

namespace app\modules\countries;

/**
 * countries module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\countries\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'countries';
        // custom initialization code goes here
    }
}
