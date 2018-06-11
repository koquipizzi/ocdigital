<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidad".
 *
 * @property int $id
 * @property string $nombre_unidad
 *
 * @property PedidoDetalle[] $pedidoDetalles
 * @property PedidoDetalle[] $pedidoDetalles0
 * @property Producto[] $productos
 */
class Unidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_unidad'], 'required'],
            [['id'], 'integer'],
            [['nombre_unidad'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre_unidad' => Yii::t('app', 'Unidad'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['unidad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles0()
    {
        return $this->hasMany(PedidoDetalle::className(), ['unidad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['unidad_id' => 'id']);
    }
}
