<?php


namespace app\modules\translates\controllers;


use app\modules\translates\models\Message;
use app\modules\translates\models\SourceMessage;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class TranslationsController extends \yii\web\Controller
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
        $sources = SourceMessage::find()
                        ->with(['messages'])
                        ->all();

        if(Yii::$app->request->post("hasEditable")){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $posts = Yii::$app->request->post("translation");
            $value_data = array_values($posts)[0];

            //LANG
            $langId = array_keys($posts)[0];
            //SOURCE ID

            $sourseId = array_keys($value_data)[0];
            //VALUE
            $value =  array_values($value_data)[0];
            $message_query = Message::find()->where(['source_message_id' => $sourseId])->andWhere(['lang_id' => $langId]);
            if($message_query->count() > 0){
                $message = $message_query->one();
            }else{
                $message = new Message();
                $message->source_message_id = $sourseId;
                $message->lang_id = $langId;
            }
            $message->translation = $value;
            $message->save();

            return ['output'=>$value, 'message'=>$message->getFirstError("translition")];
        }

        return $this->render('index',[
            'sources' => $sources,
            'idLangs' => $lang_id,
        ]);
    }
}