<?php

namespace app\modules\translates\models;

use Yii;

/**
 * This is the model class for table "source_message".
 *
 * @property int $id
 * @property string $keyword Наименование
 *
 * @property Message[] $messages
 */
class SourceMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $lang_id;
    public $translation;
    public static function tableName()
    {
        return '{{%source_message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keyword'], 'string'],
            [['translation','lang_id'], 'safe'],
            [['keyword', 'translation'], 'required'],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'ключ переводить',
            'translation' => 'Перевод',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['source_message_id' => 'id']);
    }

    public function saveMessage(){
        $message = new Message();
        $message->lang_id = $this->lang_id;
        $message->translation = $this->translation;
        $message->source_message_id = $this->id;
        $message->save();
        return true;
    }
}
