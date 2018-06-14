<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%estado}}".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property EtadoProximo[] $etadoProximos
 * @property EtadoProximo[] $etadoProximos0
 * @property Workflow[] $workflows
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%estado}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripción'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtadoProximos()
    {
        return $this->hasMany(EstadoProximo::className(), ['estado_destino_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtadoProximos0()
    {
        return $this->hasMany(EstadoProximo::className(), ['estado_origen_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkflows()
    {
        return $this->hasMany(Workflow::className(), ['estado_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EstadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadoQuery(get_called_class());
    }
}
