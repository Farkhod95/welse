<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use app\models\UserRoles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\modules\regions\models\Regions;
use app\modules\regions\models\Districts;
use app\modules\countries\models\Countries;
/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionAdmin()
    {    
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $title = 'Администраторы';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title ,
        ]);
    }

    public function actionIndex()
    {    
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->searchAdmin(Yii::$app->request->queryParams);
        $title = 'Клиенты';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title ,
        ]);
    }

    public function init()
    {
        parent::init();

        if (!Yii::$app->user->isGuest) {
            // Code to Set the last seen time for the user. For eg,
            $user = Users::findOne(Yii::$app->user->id);
            $user->last_seen = date('Y-m-d H:i:s');
            $user->save(false, ["last_seen"]);
        }
    }
    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Пользователь",
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
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
     * Creates a new Users model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Users();  
        $userRoles = new UserRoles();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Добавить нового пользователя",
                    'size'=>'large',
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->validate()){
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file && $model->validate()) {
                    $fileName = $model->file->baseName . time() . '.' . $model->file->extension;
                    $model->file->saveAs('uploads/avatar/' . $fileName);
                    $model->avatar =  $fileName;
                    $model->save();
                }
                $model->save();
                $userRoles->user_id = $model->id;
                $userRoles->role_id = 5;
                $userRoles->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Добавить нового пользователя",
                    'content'=>'<span class="text-success">Успешно создано</span>',
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Создать больше',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Добавить нового пользователя",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
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
                ]);
            }
        }
       
    }
    public function actionProfile()
    {
        $user_info =  Users::find()->where(['id' => Yii::$app->user->identity->id])->one();
        return $this->render('profile_view',[
            'user_info' => $user_info,
            ]);
    }
    public function actionUpdateAdminProfile($id)
    {
        $model = $this->findModel($id);
        $random = substr(number_format(time() * rand(),0,'',''),0,10);
        $old = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $fileName = $model->file->baseName . $random . '.' . $model->file->extension;
                $model->file->saveAs('uploads/avatar/' . $fileName);
                $model->avatar =  $fileName;
                $model->save();
                $fileName = 'uploads/avatar/' . $old->avatar;
                if(file_exists($fileName) && $old->avatar != null) unlink(Yii::getAlias($fileName));
            }
            return $this->redirect(['profile']);
        }

        return $this->render('_form_admin_profile', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Users model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
        $random = substr(number_format(time() * rand(),0,'',''),0,10);
        $old = $this->findModel($id);
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
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file && $model->validate()) {
                    $fileName = $model->file->baseName . $random . '.' . $model->file->extension;
                    $model->file->saveAs('uploads/avatar/' . $fileName);
                    $model->avatar =  $fileName;
                    $model->save();
                    $fileName = 'uploads/avatar/' . $old->avatar;
                    if(file_exists($fileName) && $old->avatar != null) unlink(Yii::getAlias($fileName));
                }
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Пользователь",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> Yii::t('app','Edit'),
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                ]);
            }
        }
    }

    /**
     * Delete an existing Users model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            $fileName = 'uploads/avatar/' . $model->avatar;
            if(file_exists($fileName) && $model->avatar != null) unlink(Yii::getAlias($fileName));
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
     * Delete multiple existing Users model.
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
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
