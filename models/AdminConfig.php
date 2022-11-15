<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_config".
 *
 * @property string $key
 * @property string $value
 */
class AdminConfig extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_config';
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
}
