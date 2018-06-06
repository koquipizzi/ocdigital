<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property ClienteRol[] $clienteRols
 * @property Cliente[] $clientes
 * @property Producto[] $productos
 */
class Rol extends \yii\db\ActiveRecord
{

    const DEFAULTROLID = 1;
    const HIDDENROLID = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteRols()
    {
        return $this->hasMany(ClienteRol::className(), ['rol_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['id' => 'cliente_id'])->viaTable('cliente_rol', ['rol_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['rol_id' => 'id']);
    }
}
