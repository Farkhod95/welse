<?php

namespace app\controllers;

use app\modules\translates\models\Langs;

use Yii;
use app\models\Blogs;
use app\models\BlogTagsRelations;
use app\models\BlogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use app\modules\countries\models\Countries;
use yii\filters\AccessControl;
/**
 * BlogsController implements the CRUD actions for Blogs model.
 */
class BlogsController extends Controller
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
     * Lists all Blogs models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new BlogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Blogs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->getTranslates();
        $available_languages = Langs::getLanguages();

        $tagsSearchModel = new BlogTagsRelations();
        $tagsDataProvider = $tagsSearchModel->search(Yii::$app->request->queryParams, $id);  
        
        return $this->render('view', [
            'model' => $model,
            'available_languages' => $available_languages,
            'tagsDataProvider' => $tagsDataProvider,
        ]);
    }
    public function actionRegions($id)
    {
        $datas = Countries::find()->where(['id' => $id])->one();
        $region = Regions::find()->where(['country_id' => $datas->id])->all();
        foreach ($region as $value) {
            echo "<option value = '".$value->id."'>".$value->name."</option>" ;
        }
    }

    public function actionDistricts($id)
    {
        $datas = Regions::find()->where(['id' => $id])->one();
        $district = Districts::find()->where(['region_id' => $datas->id])->all();
        foreach ($district as $value) {
            echo "<option value = '".$value->id."'>".$value->name."</option>" ;
        }
    }
    /**
     * Creates a new Blogs model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Blogs();  
        $available_languages = Langs::getLanguages();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Добавить",
                    'size'=>'large',
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->setPostTags();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Добавить",
                    'content'=>'<span class="text-success">Успешно создано</span>',
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Создать больше',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Добавить",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'available_languages' => $available_languages
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Blogs model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);   
        $model->tags = $model->getTags();
        $model->getTranslates();
        $available_languages = Langs::getLanguages();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('app','Edit'),
                    'size'=>'large',
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->setPostTags();
                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];   
            }else{
                 return [
                    'title'=> Yii::t('app','Edit'),
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'available_languages' => $available_languages
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'available_languages' => $available_languages
                ]);
            }
        }
    }

    /**
     * Delete an existing Blogs model.
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
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Blogs model.
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
     * Finds the Blogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
