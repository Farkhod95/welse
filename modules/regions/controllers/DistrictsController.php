<?php

namespace app\modules\regions\controllers;

use app\modules\translates\models\Langs;
use Yii;
use app\modules\regions\models\Districts;
use app\modules\regions\models\DistrictsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * DistrictsController implements the CRUD actions for Districts model.
 */
class DistrictsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Districts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->getTranslates();
        $available_languages = Langs::getLanguages();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> Yii::t('app','Districts #').$id,
                'content'=>$this->renderAjax('view', [
                    'model' => $model,
                    'available_languages' => $available_languages
                ]),
                'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        }
    }

    /**
     * Creates a new Districts model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $request = Yii::$app->request;
        $model = new Districts();
        $model->region_id = $id;
        $available_languages = Langs::getLanguages();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-districts-pjax',
                    'title'=> Yii::t('app','Create'),
                    'content'=>'<span class="text-success">'.Yii::t('app','Done successfully').'</span>',
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Create More'),['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];
            }else{
                return [
                    'title'=> Yii::t('app','Create'),
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        }
    }

    /**
     * Updates an existing Districts model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $available_languages = Langs::getLanguages();
        $model->getTranslates();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-districts-pjax',
                    'title'=> Yii::t('app','Districts #').$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> Yii::t('app','Update'),
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }
    }

    /**
     * Delete an existing Districts model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-districts-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Districts model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-districts-pjax',];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Districts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Districts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Districts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
