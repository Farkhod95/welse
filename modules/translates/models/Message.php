<?php

namespace app\modules\translates\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $translation Перевод
 * @property int $lang_id Язык
 * @property int $source_message_id Ключевая слова
 *
 * @property Langs $lang
 * @property SourceMessage $sourceMessage
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['translation'], 'string'],
            [['lang_id', 'source_message_id'], 'default', 'value' => null],
            [['lang_id', 'source_message_id'], 'integer'],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang_id' => 'id']],
            [['source_message_id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceMessage::className(), 'targetAttribute' => ['source_message_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'translation' => 'Перевод',
            'lang_id' => 'Язык',
            'source_message_id' => 'Ключевая слова',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Langs::className(), ['id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessage()
    {
        return $this->hasOne(SourceMessage::className(), ['id' => 'source_message_id']);
    }
}
