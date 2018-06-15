<?php

namespace app\models;


use Yii;
use app\models\ProductoRol;
use app\models\Rol;
use app\models\ClienteRol;
/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $razon_social
 * @property string $nombre
 * @property string $apellido
 * @property string $usuario_web
 * @property string $password_web
* @property int $web_customer_id
* @property int $maxirest_id
* @property string $ultima_modificacion
 * @property string $email
 *  @property string $direccion 
 * @property string $contacto 
 * @property string $telefono 
 * @property string $hora_reparto
 * @property string $ciudad

 *
 * @property ClienteRol[] $clienteRols
 * @property Rol[] $rols
 * @property Pedido[] $pedidos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['web_customer_id'], 'integer'],
           // [['email'], 'required'],
            [['razon_social', 'nombre', 'apellido', 'email', 'ciudad'], 'string', 'max' => 255],
            [['nombre', 'apellido','razon_social'], 'required'],
            [['web_customer_id', 'maxirest_id','documento'], 'integer'],
            [['ultima_modificacion'], 'safe'],
            [['razon_social', 'nombre', 'apellido', 'email', 'direccion', 'contacto', 'telefono', 'hora_reparto', 'codigo', 'codigo_nombre_cliente'], 'string', 'max' => 255],
            [['usuario_web', 'password_web'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'razon_social' => Yii::t('app', 'Razon Social'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'usuario_web' => Yii::t('app', 'Usuario Web'),
            'password_web' => Yii::t('app', 'Password Web'),
            'web_customer_id' => Yii::t('app', 'Web Customer ID'),
            'maxirest_id' => Yii::t('app', 'Maxirest ID'), 
            'ultima_modificacion' => Yii::t('app', 'Ultima Modificacion'), 
            'email' => Yii::t('app', 'Email'),
            'direccion' => Yii::t('app', 'Dirección'), 
            'contacto' => Yii::t('app', 'Contacto'), 
            'telefono' => Yii::t('app', 'Telefono'), 
            'hora_reparto' => Yii::t('app', 'Hora Reparto'),
            'codigo' => Yii::t('app', 'Código'),
            'codigo_nombre_cliente' => Yii::t('app', 'Codigo Nombre Cliente'),
            'documento' => Yii::t('app', 'Documento'),
            'ciudad' => Yii::t('app', 'Ciudad'),
            'viajante_id' => Yii::t('app', 'Vendedor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteRols()
    {
        return $this->hasMany(ClienteRol::className(), ['cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Rol::className(), ['id' => 'rol_id'])->viaTable('cliente_rol', ['cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['cliente_id' => 'id']);
    }

    public function getProductos()
    {
      $prodRol = [];
      $rol = $this->getClienteRol();
      if (!empty($rol)) {
        $productsRols = ProductoRol::find()->where(['rol_id' => $rol->id])->all();
        foreach( $productsRols as  $productRol)
        {
            $prodRol[] = $productRol->producto_id;
        }
        $products = Producto::find()->where(['in', 'id', $prodRol])->all();
        return $products;
      }else{
        return null;
      }
    }

    public function getClienteRol()
    {
      $clienteRol = ClienteRol::find()->where(['cliente_id' => $this->id])->andWhere(['<>','rol_id', Rol::DEFAULTROLID])->one();
      if (!empty($clienteRol)) {
        $rol_id = $clienteRol->rol_id;
      }else{
        $rol_id = $this->newClienteRol($this->id);
      }
      return Rol::find()->where(['id' => $rol_id ])->one();
    }

    public static function getTotalClientes()
    {
        return Cliente::find()->count();
    }

    private function newClienteRol($cliente_id)
    {
      $modelRol = new Rol();
      $modelRol->nombre = "r$cliente_id";
      $modelRol->save();

      //seteo la relacion entre el rol y el cliente
      $modelClienteRol = new ClienteRol();
      $modelClienteRol->cliente_id = $cliente_id;
      $modelClienteRol->rol_id = $modelRol->id;
      $modelClienteRol->save();

      return $modelRol->id;
    }


}
