<?php


namespace app\modules\translates\controllers;


use app\modules\translates\models\Langs;
use app\modules\translates\models\Translates;
use app\modules\translates\models\TranslatesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

class TranslatesController extends \yii\web\Controller
{

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
     * tarjimalarni boshqarish
     * @param $lang_id
     * @return array|string
     */
    public function actionIndex($lang_id)
    {
        $langs = Langs::find()->where(['id' => $lang_id])->one();
        // $translates = Translates::find()->where(['language_code' => $langs->url])->all();   
        $searchModel = new TranslatesSearch(['language_code' => $langs->url]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'langs' => $langs,
            'lang_id' => $lang_id,
        ]);
    }
    public function actionUpdate($id)
    {
        // echo '<pre>';
        // print_r($id);
        // echo '</pre>';
        $request = Yii::$app->request;
        $model = Translates::find()->where(['id' => $id])->one();
        // $model = $this->findModel(12);       
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> Yii::t('app','Edit'),
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Сохранить',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return ['forceClose'=>true,'forceReload'=>'#crud1-datatable-pjax'];       
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
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        // $this->findModel(1)->delete();
        Translates::find()->where(['id' => $id])->one()->delete();
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud1-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }
}