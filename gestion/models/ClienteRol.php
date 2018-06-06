<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente_rol".
 *
 * @property integer $cliente_id
 * @property integer $rol_id
 *
 * @property Cliente $cliente
 * @property Rol $rol
 */
class ClienteRol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente_rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cliente_id', 'rol_id'], 'required'],
            [['cliente_id', 'rol_id'], 'integer'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cliente_id' => Yii::t('app', 'Cliente ID'),
            'rol_id' => Yii::t('app', 'Rol ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }
}
