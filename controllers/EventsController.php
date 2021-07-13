<?php

namespace app\controllers;

use Yii;
use app\models\Events;
use app\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use app\modules\countries\models\Countries;
use app\models\EventMembers;
use app\models\EventMembersSearch;
/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex($id)
    {    
        $searchModel = new EventsSearch(['category_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $searchModel = new EventMembersSearch(['event_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Событие",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Редактировать',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
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
     * Creates a new Events model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Events();

        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
            $model->category_id = $id;
            $model->save();
            return $this->redirect(['index', 'id' => $id]);
        }

        return $this->render('create', [
            'id' => $id,
            'model' => $model,
        ]);
    }
    // public function actionCreateMembers()
    // {
    //     $request = Yii::$app->request;
    //     $model = new EventMembers();  

    //     if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         if($request->isGet){
    //             return [
    //                 'title'=> "Создать",
    //                 'content'=>$this->renderAjax('create', [
    //                     'model' => $model,
    //                 ]),
    //                 'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                             Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
    //             ];         
    //         }else if($model->load($request->post()) && $model->save()){
    //             return [
    //                 'forceReload'=>'#crud1-datatable-pjax',
    //                 'title'=> "Создать",
    //                 'content'=>'<span class="text-success">Успех создания ролей</span>',
    //                 'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                         Html::a('Создать больше',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
    //             ];         
    //         }else{           
    //             return [
    //                 'title'=> "Создать",
    //                 'content'=>$this->renderAjax('create', [
    //                     'model' => $model,
    //                 ]),
    //                 'footer'=> Html::button('Закрыть',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
    //                             Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
    //             ];         
    //         }
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         if ($model->load($request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         } else {
    //             return $this->render('create', [
    //                 'model' => $model,
    //             ]);
    //         }
    //     }
       
    // }
    /**
     * Updates an existing Events model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Delete an existing Events model.
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
     * Delete multiple existing Events model.
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
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
