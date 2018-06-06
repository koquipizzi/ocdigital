<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "producto".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $categoria_id
 * @property string $precio_unitario
 * @property integer $web_id
 *
 * @property ComandaDetalle[] $comandaDetalles
 * @property PedidoDetalle[] $pedidoDetalles
 * @property Categoria $categoria
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ 'categoria_id', 'required'],
            [[ 'categoria_id', 'web_id','maxirest_id'], 'integer'],
            [['precio_unitario','web_id'], 'number'],
            [['nombre'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
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
            'categoria_id' => Yii::t('app', 'Categoría'),
            'precio_unitario' => Yii::t('app', 'Precio Unitario'),
            'web_id' => Yii::t('app', 'Web ID'),
            'maxirest_id' => Yii::t('app', 'Maxirest ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComandaDetalles()
    {
        return $this->hasMany(ComandaDetalle::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }

    public function getProductoCatWebID()
    {
      $modelCategoria= new Categoria();
      $categoria = $modelCategoria->find()->where(['id' => $this->categoria_id])->one();
      return $categoria->web_id;
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

    public static function getTotalProductos()
    {
        return Producto::find()->count();
    }

    public static function getProductosActivos()
    {
        $productosPendientes = ProductoRol::find()->all();
        $pd = [];
        foreach ($productosPendientes as $productoPendiente) {
            $pd[] =  $productoPendiente->producto_id;
        }
        $productos = Producto::find()->where(['in', 'id' , $pd])->all();
        return $productos;
    }
}
