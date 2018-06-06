<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto_rol".
 *
 * @property int $id
 * @property int $producto_id
 * @property int $rol_id
 *
 * @property Producto $producto
 * @property Rol $rol
 */
class ProductoRol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto_rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producto_id', 'rol_id'], 'required'],
            [['producto_id', 'rol_id'], 'integer'],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
            [['rol_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'producto_id' => Yii::t('app', 'Producto ID'),
            'rol_id' => Yii::t('app', 'Rol ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }

    /**
     * @inheritdoc
     * @return ProductoRolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductoRolQuery(get_called_class());
    }
}
