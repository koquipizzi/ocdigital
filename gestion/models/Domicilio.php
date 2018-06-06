<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "domicilio".
 *
 * @property integer $id
 * @property string $calle
 * @property string $nro
 * @property integer $cliente_id
 *
 * @property Cliente $cliente
 * @property Pedido[] $pedidos
 */
class Domicilio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domicilio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cliente_id'], 'required'],
            [['cliente_id'], 'integer'],
            [['calle'], 'string', 'max' => 255],
            [['nro'], 'string', 'max' => 10],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'calle' => Yii::t('app', 'Calle'),
            'nro' => Yii::t('app', 'Nro'),
            'cliente_id' => Yii::t('app', 'Cliente ID'),
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
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['domicilio_id' => 'id']);
    }
}
