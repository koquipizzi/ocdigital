<?php

namespace app\models;

use Yii;
use Empathy\Validators\DateTimeCompareValidator;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "comanda".
 *
 * @property integer $id
 * @property string $fecha_produccion
 * @property resource $nota
 *
 * @property ComandaDetalle[] $comandaDetalles
 * @property Pedido[] $pedidos
 */
class Comanda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comanda';
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
            [['fecha_produccion'], 'safe'],
            [['nota'], 'string'],
            ['fecha_produccion', DateTimeCompareValidator::className(), 'compareValue' => date('Y-m-d'), 'operator' => '>='],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_produccion' => Yii::t('app', 'Fecha de Entrega'),
            'nota' => Yii::t('app', 'Nota'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComandaDetalles()
    {
        return $this->hasMany(ComandaDetalle::className(), ['comanda_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['comanda_id' => 'id'])->orderBy(['orden_reparto' => SORT_ASC]);
    }

    public function getFechaProduccion()
    {
        $fecha= $this->fecha_produccion;
        $arr = explode('-',$fecha);
        return $arr[2].'-'.$arr[1].'-'.$arr[0];
    }

    public function getNotaTexto()
    {
        $notaText= $this->nota;
        if (strlen($notaText) > 20)
            $notaText = substr($notaText, 0, 20);
        return $notaText;
    }

    public static function getEstadoComanda()
    {
        $fecha = new \DateTime('today');
        $fecha = $fecha->format('Y-m-d');
        return Comanda::find()->where(['>=','fecha_produccion' , $fecha ])->one();
    }
    
    public static function getCantCategorias($id)
    {
        $pedidosComanda = ComandaDetalle::find()->select('producto_id')->where(['comanda_id' => $id])->groupBy(['producto_id'])->all();
        $productosID = ArrayHelper::map($pedidosComanda,'producto_id','producto_id');
        return (int) Producto::find()->select('categoria_id')->where(['in', 'id', $productosID])->groupBy(['categoria_id'])->count();
    }

}
