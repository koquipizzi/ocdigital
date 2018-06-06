<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property string $ptime
 * @property int $cont
 * @property int $pid
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ptime'], 'safe'],
            [['cont', 'pid'], 'required'],
            [['cont', 'pid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ptime' => Yii::t('app', 'Ptime'),
            'cont' => Yii::t('app', 'Contador'),
            'pid' => Yii::t('app', 'ID del Proceso'),
        ];
    }

    public static function primaryKey()
    {
      return ['pid'];
    }
}
