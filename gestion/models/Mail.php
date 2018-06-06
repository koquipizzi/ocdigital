<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mail".
 *
 * @property int $id
 * @property string $accion
 * @property string $mails
 */
class Mail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accion'], 'string', 'max' => 45],
            [['mails'], 'string', 'max' => 1255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'accion' => Yii::t('app', 'Accion'),
            'mails' => Yii::t('app', 'Mails'),
        ];
    }
}
