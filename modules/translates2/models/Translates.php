<?php

namespace app\modules\translates\models;

use Yii;

/**
 * This is the model class for table "translates".
 *
 * @property int $id
 * @property string $table_name Наименование таблици
 * @property int $field_id ID строка
 * @property string $field_name  Наименование строка
 * @property string $field_description  Описание поля
 * @property string $field_value Значение
 * @property string $language_code Код языка
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
            [['field_id'], 'default', 'value' => null],
            [['field_id'], 'integer'],
            [['table_name', 'field_name', 'field_description', 'field_value', 'language_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Наименование таблици',
            'field_id' => 'ID строка',
            'field_name' => ' Наименование строка',
            'field_description' => ' Описание поля',
            'field_value' => 'Значение',
            'language_code' => 'Код языка',
        ];
    }
}
