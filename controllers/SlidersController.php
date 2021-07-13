<?php

namespace app\controllers;

use app\modules\translates\models\Langs;

use Yii;
use app\models\Sliders;
use app\models\SlidersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use app\models\SliderItems;
use app\models\SliderItemsSearch;
/**
 * SlidersController implements the CRUD actions for Sliders model.
 */
class SlidersController extends Controller
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
     * Lists all Sliders models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SlidersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Sliders model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->getTranslates();
        $available_languages = Langs::getLanguages();

        $searchSlidersItems = new SliderItemsSearch(['slider_id' => $id]);
        $dataSlidersItems = $searchSlidersItems->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $model,
            'available_languages' => $available_languages,
            'searchSlidersItems' => $searchSlidersItems,
            'dataSlidersItems' => $dataSlidersItems,
        ]);
    }
    /**
     * Creates a new Sliders model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sliders();
        $available_languages = Langs::getLanguages();
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {

            $model->filePhoto = UploadedFile::getInstance($model, 'filePhoto');
            if ($model->filePhoto && $model->validate()) {
                $fileName = $model->filePhoto->baseName . time() . '.' . $model->filePhoto->extension;
                $model->filePhoto->saveAs('uploads/slider/' . $fileName);
                $model->image =  $fileName;
                $model->save();
            }
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'available_languages' => $available_languages
        ]);
    }

    /**
     * Updates an existing Sliders model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $random = substr(number_format(time() * rand(),0,'',''),0,10);
        $old = $this->findModel($id);

        $model->getTranslates();
        $available_languages = Langs::getLanguages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->filePhoto = UploadedFile::getInstance($model, 'filePhoto');
            if ($model->filePhoto && $model->validate()) {
                $fileName = $model->filePhoto->baseName . $random . '.' . $model->filePhoto->extension;
                $model->filePhoto->saveAs('uploads/slider/' . $fileName);
                $model->image =  $fileName;
                $model->save();
                $fileName = 'uploads/slider/' . $old->image;
                if(file_exists($fileName) && $old->image != null) unlink(Yii::getAlias($fileName));
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'available_languages' => $available_languages
        ]);
    }

    /**
     * Delete an existing Sliders model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $fileName = 'uploads/slider/' . $model->image;
            if(file_exists($fileName) && $model->image != null) unlink(Yii::getAlias($fileName));

            $this->findModel($id)->delete();
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Sliders model.
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
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Sliders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sliders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sliders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
