<?php

//namespace app\models;
namespace amnah\yii2\user\models;
use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "admin_config".
 *
 * @property string $key
 * @property string $value
 */
class AdminConfig extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_configs';
    }
   public static function primaryKey()
   {
       return ['key'];
   }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'key',
            'value' => 'value',
        ];
    }
    public function getConfigHistory()
    {
        return static::findOne(['key'=>'hide_history']);
    }
}
