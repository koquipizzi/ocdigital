<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%workflow}}".
 *
 * @property int $id
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property int $estado_id
 * @property int $user_id
 * @property int $pedido_id
 *
 * @property Estado $estado
 * @property Pedido $pedido
 * @property User $user
 */
class Workflow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%workflow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_inicio', 'estado_id', 'user_id', 'pedido_id'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['estado_id', 'user_id', 'pedido_id'], 'integer'],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_id' => 'id']],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['pedido_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha Fin'),
            'estado_id' => Yii::t('app', 'Estado ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'pedido_id' => Yii::t('app', 'Pedido ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return WorkflowQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkflowQuery(get_called_class());
    }
    
    public static function lastStatePedido($pedido_id){
        $query = new Query;
        $query->select('id')
         ->from('view_pedido_ult_workflow')
         ->where(["view_pedido_ult_workflow.pedido_id" => $pedido_id]);
        $command = $query->createCommand();
        $data = $command->queryAll();

        if(empty($data) || !is_array($data[0] )){
            throw new \Exception("No se econtro el utlimo estado del pedido {$pedido_id}.");
        }
       return $data[0]['id'];
    }

}
