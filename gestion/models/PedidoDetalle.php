<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use app\models\Unidad;
use Yii;

/**
 * This is the model class for table "pedido_detalle".
 *
 * @property integer $id
 * @property integer $pedido_id
 * @property integer $producto_id
 * @property integer $cantidad
 * @property string $precio_linea
 * @property Unidad $unidad
 * @property Pedido $pedido
 * @property Producto $producto
 */
class PedidoDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pedido_id', 'producto_id', 'cantidad', 'precio_linea','precio_unitario','unidad_id'], 'required'],
            [['pedido_id', 'producto_id', 'cantidad', 'unidad_id',], 'integer'],
            [['precio_linea','precio_unitario'], 'number'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
            [['producto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['producto_id' => 'id']],
            [['unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['unidad_id' => 'id']],
            [['unidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidad::className(), 'targetAttribute' => ['unidad_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pedido_id' => Yii::t('app', 'Pedido'),
            'producto_id' => Yii::t('app', 'Producto'),
            'cantidad' => Yii::t('app', 'Cantidad'),
            'precio_linea' => Yii::t('app', 'SubTotal'),
            'unidad_id' => Yii::t('app', 'Unidad'),
            'precio_unitario' => Yii::t('app', 'Precio Unitario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedido::className(), ['id' => 'pedido_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }

    public function getDescripcionproducto()
    {
        $producto = $this->hasOne(Producto::className(), ['id' => 'producto_id'])->one();
        if ($producto)
            return $producto->nombre;
        return '';
    }
    
    public function getCodigoproducto()
    {
        $producto = $this->hasOne(Producto::className(), ['id' => 'producto_id'])->one();
        if ($producto)
            return $producto->codigo;
        return '';
    }

    public function getDescripcioncliente()
    {
        $pedido = $this->hasOne(Pedido::className(), ['id' => 'producto_id'])->one();
        $cliente = $pedido->getClienteRazonSocial();
        if ($cliente)
            return $cliente;
        return '';
    }
    
    public function getUnidad()
    {
        return $this->hasOne(Unidad::className(), ['id' => 'unidad_id']);
    }
    
    
    public static function createMultiple($modelClass, $multipleModels = [])
   {
       $model    = new $modelClass;
       $formName = $model->formName();
       $post     = Yii::$app->request->post($formName);
       $models   = [];

       if (! empty($multipleModels)) {
           $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
           $multipleModels = array_combine($keys, $multipleModels);
       }

       if ($post && is_array($post)) {
           foreach ($post as $i => $item) {
               if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                   $models[] = $multipleModels[$item['id']];
               } else {
                   $models[] = new $modelClass;
               }
           }
       }

       unset($model, $formName, $post);

       return $models;
   }
}
