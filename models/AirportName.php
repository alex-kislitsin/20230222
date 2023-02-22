<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\db\Connection;

/**
 * This is the model class for table "airport_name".
 *
 * @property int $id
 * @property int $airport_id
 * @property int|null $language_id
 * @property string $value
 */
class AirportName extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'airport_name';
    }

    /**
     * @return object|Connection
     * @throws InvalidConfigException
     */
    public static function getDb()
    {
        return Yii::$app->get('dbGuideEtalon');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['airport_id', 'value'], 'required'],
            [['airport_id', 'language_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'airport_id' => 'Airport ID',
            'language_id' => 'Language ID',
            'value' => 'Value',
        ];
    }
}
