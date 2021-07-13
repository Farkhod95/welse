<?php


namespace app\controllers;


use yii\web\Controller;

/**
 * Class AppController
 * @package app\controllers
 */
class AppController extends Controller
{
    /**
     * This function render error page
     *
     * @param string $message
     * @return string
     */
    public function abort(string $message = ''){
        return $this->render(
            '/site/error',
            ['name' => $message]
        );
    }
}