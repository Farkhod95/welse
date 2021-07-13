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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['source_message_id' => 'id']);
    }
}
