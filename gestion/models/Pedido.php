<?php

namespace app\models;

use Yii;
use app\models\Cliente;
use Empathy\Validators\DateTimeCompareValidator;
/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property string $fecha_hora
 * @property string $fecha_produccion
 * @property string $fecha_entrega
 * @property integer $web_id
 * @property integer $cliente_id
 * @property integer $comanda_id
 * @property int $orden_reparto
 * @property string $precio_total
 * @property string $contacto
 * @property string $ship_company
 * @property string $ship_address_1
 * @property string $ship_address_2
 * @property string $ship_city
 * @property string $ship_state
 * @property string $ship_postcode
 * @property string $ship_country
 * @property string $estado
 *
 * @property Cliente $cliente
 * @property Comanda $comanda
 * @property PedidoDetalle[] $pedidoDetalles
 */
class Pedido extends \yii\db\ActiveRecord
{

    const ESTADO_PROCESANDO = 'processing';
    const ESTADO_COMPLETADO = 'completed';
    const ESTADO_CANCELADO = 'cancelled';
    const ESTADO_MANUAL = 'Manual';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_hora', 'fecha_produccion', 'fecha_entrega'], 'safe'],
            [['web_id', 'cliente_id', 'comanda_id', 'orden_reparto', 'confirmado', 'facturable', 'flete_bonificado', 'sync', 'gestor_id'], 'integer'],
            [['cliente_id'], 'required'],
            [['precio_total', 'flete_valor'], 'number'],
            [['ship_company', 'ship_address_1', 'ship_address_2', 'ship_city', 'ship_state', 'ship_postcode', 'ship_country', 'cond_venta', 'notas', 'telefono', 'responsable_recepcion', 'hora_de_recepción'], 'string', 'max' => 255],
            [['estado'], 'string', 'max' => 100],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['comanda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comanda::className(), 'targetAttribute' => ['comanda_id' => 'id']],
            [['gestor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['gestor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_hora' => Yii::t('app', 'Fecha Hora'),
            'fecha_produccion' => Yii::t('app', 'Fecha Produccion'),
            'web_id' => Yii::t('app', 'Web ID'),
            'cliente_id' => Yii::t('app', 'Cliente'),
            'comanda_id' => Yii::t('app', 'Comanda ID'),
            'orden_reparto' => Yii::t('app', 'Comanda ID'),
            'precio_total' => Yii::t('app', 'Precio Total'),
            'contacto' => Yii::t('app', 'Contacto'),
            'ship_company' => Yii::t('app', 'Empresa'),
            'ship_address_2' => Yii::t('app', 'Dirección'),
            'ship_address_1' => Yii::t('app', 'Dirección'),
            'ship_city' => Yii::t('app', 'Ciudad '),
            'ship_state' => Yii::t('app', 'Provincia'),
            'ship_postcode' => Yii::t('app', 'Codigo Postal'),
            'ship_country' => Yii::t('app', 'Pais'),
            'estado' => Yii::t('app', 'Estado'),
            'confirmado' => Yii::t('app', 'Confirmado'),
            'facturable' => Yii::t('app', 'Facturable'),
            'flete_bonificado' => Yii::t('app', 'Flete Bonificado'),
            'flete_valor' => Yii::t('app', 'Valor del Flete'),
            'sync' => Yii::t('app','Sincronizado'), 'cond_venta' => Yii::t('app', 'Cond Venta'),
            'notas' => Yii::t('app', 'Notas'),
            'telefono' => Yii::t('app', 'Telefono'),
            'responsable_recepcion' => Yii::t('app', 'Responsable Recepcion'),
            'hora_de_recepción' => Yii::t('app', 'Hora De Recepción'),
            'gestor_id' => Yii::t('app', 'Gestor ID'),
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
    public function getComanda()
    {
        return $this->hasOne(Comanda::className(), ['id' => 'comanda_id']);
    }

    public function getContacto()
    {
      $modelCliente = Cliente::find()->where(['id' => $this->cliente_id])->one();
      if (empty($modelCliente)){
        return ' ';
      }else{
        $condicion = !empty($modelCliente->contacto);
        return $condicion ? $modelCliente->contacto : "" ;
      }
    }

    public function getTelefono()
    {
      $modelCliente = Cliente::find()->where(['id' => $this->cliente_id])->one();
      if (empty($modelCliente)){
        return ' ';
      }else{
        $condicion = !empty($modelCliente->telefono);
        return $condicion ? $modelCliente->telefono : "" ;
      }
    }

    public function getHoraEntrega()
    {
      $modelCliente = Cliente::find()->where(['id' => $this->cliente_id])->one();
      if (empty($modelCliente)){
        return ' ';
      }else{
        $condicion = !empty($modelCliente->hora_reparto);
        return $condicion ? $modelCliente->hora_reparto : "" ;
      }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::className(), ['pedido_id' => 'id']);
    }

    public function getClienteRazonSocial()
    {
      $modelCliente = Cliente::find()->where(['id' => $this->cliente_id])->one();
      if (empty($modelCliente)){
        return ' ';
      }else{
        $condicion = !empty($modelCliente->razon_social);
        return $condicion ? $modelCliente->razon_social : $modelCliente->nombre ;
      }
    }

    public function getClienteMail()
    {
        $modelCliente = Cliente::find()->where(['id' => $this->cliente_id])->one();
        if (empty($modelCliente)){
          return ' ';
        }else{
          return $modelCliente->email;
        }
    }

    public function getTotalPedido()
    {
        return (float) $this->precio_total + (float) $this->flete_valor;
    }

    public static function getTotalPedidosPendientes()
    {
       return Pedido::find()->where(['comanda_id' => null])
                            ->andWhere(['or',['estado'=> Pedido::ESTADO_MANUAL],
                                             ['estado'=> Pedido::ESTADO_PROCESANDO]
                                       ])->count();
    }

    public function afterSave($insert, $changeAttributes){
      if (empty($this->orden_reparto)) {
        $this->orden_reparto = $this->id;
        $this->save();
      }
    }
    
    public static function getPTotal($provider, $fieldName)
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }
        
            $total = Yii::$app->formatter->asCurrency($total);
        
        return $total;
    }
    
    public function getGestorPedidoName(){
        $gestorid = $this->gestor_id;
        $usuario = User::find()->where(['id' => $gestorid ])->one();
        if (!empty($usuario)){
            $clienteNombre = $usuario->username;
            return $clienteNombre;
        }
        return null;
    }

}
