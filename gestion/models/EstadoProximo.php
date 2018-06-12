<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%estado_proximo}}".
 *
 * @property int $id
 * @property int $estado_origen_id
 * @property int $estado_destino_id
 *
 * @property Estado $estadoDestino
 * @property Estado $estadoOrigen
 */
class EstadoProximo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%estado_proximo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado_origen_id', 'estado_destino_id'], 'required'],
            [['estado_origen_id', 'estado_destino_id'], 'integer'],
            [['estado_destino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_destino_id' => 'id']],
            [['estado_origen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_origen_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estado_origen_id' => Yii::t('app', 'Estado Origen ID'),
            'estado_destino_id' => Yii::t('app', 'Estado Destino ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoDestino()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado_destino_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoOrigen()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado_origen_id']);
    }

    /**
     * @inheritdoc
     * @return EstadoProximoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadoProximoQuery(get_called_class());
    }
    
    //obtiene el estado_destino dado un estado_origen
    public static function estadoProximo($estado_id){
    
    
    }
    
}
