<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{

    public $file;
    public $type;
    /**
     * @return array the validation rules.
     */
    public function rules() 
    {
        return [
            [['file'], 'file'],
            // [['file'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'xls, xlsx',],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Файл',
        ];
    }
}
?>