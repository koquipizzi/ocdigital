<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comanda_detalle".
 *
 * @property integer $id
 * @property integer $cantidad_produccion
 * @property integer $comanda_id
 * @property integer $producto_id
 *
 * @property Comanda $comanda
 * @property Producto $producto
 */
class ComandaDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comanda_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cantidad_produccion', 'comanda_id', 'producto_id'], 'integer'],
            [['comanda_id', 'producto_id'], 'required'],
            [['comanda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comanda::className(), 'targetAttribute' => ['comanda_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cantidad_produccion' => Yii::t('app', 'Cantidad Produccion'),
            'comanda_id' => Yii::t('app', 'Comanda ID'),
            'producto_id' => Yii::t('app', 'Producto ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComanda()
    {
        return $this->hasOne(Comanda::className(), ['id' => 'comanda_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }
}
