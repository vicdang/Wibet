<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_configs".
 *
 * @property string $key
 * @property string $value
 */
class AdminConfig extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'admin_configs';
    }

    public static function primaryKey()
    {
        return ['key'];
    }

    public function rules()
    {
        return [
            [['key', 'value'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'key' => 'key',
            'value' => 'value',
        ];
    }

    public static function get($key, $default = null)
    {
        $config = static::findOne(['key' => $key]);
        return $config ? $config->value : $default;
    }

    public static function set($key, $value)
    {
        $config = static::findOne(['key' => $key]);
        if (!$config) {
            $config = new static();
            $config->key = $key;
        }
        $config->value = $value;
        return $config->save();
    }

    public static function getTheme()
    {
        return static::get('theme', 'dark');
    }

    public static function getSeasonName()
    {
        $val = static::get('season_name');
        return $val ?: Yii::$app->params['seasonName'];
    }
}
