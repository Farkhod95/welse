<?php

namespace app\modules\regions;

/**
 * regions module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\regions\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'regions';
        // custom initialization code goes here
    }
}
