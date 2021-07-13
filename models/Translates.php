<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_table_of_translates".
 *
 * @property int $id
 * @property string|null $table_name table_name
 * @property string|null $language_code language_code
 * @property int|null $field_id field_id
 * @property string|null $field_name field_name
 * @property string|null $field_value field_value
 * @property string|null $field_description Описание поля
 */
class Translates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%translates}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['field_id'], 'integer'],
            [['field_value'], 'string'],
            [['table_name', 'language_code', 'field_name', 'field_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Имя таблицы',
            'language_code' => 'Код языка',
            'field_id' => 'Поле',
            'field_name' => 'Имя поля',
            'field_value' => 'Значение поля',
            'field_description' => 'Описание поля',
        ];
    }
}
