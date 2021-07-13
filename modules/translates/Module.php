<?php

namespace app\modules\translates;

/**
 * translates module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\translates\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'langs';
        // custom initialization code goes here
    }
}
