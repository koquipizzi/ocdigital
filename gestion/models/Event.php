<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property string $allDay
 * @property string $start
 * @property string $end
 * @property string $entrega
 * @property string $url
 * @property string $className
 * @property string $editable
 * @property string $startEditable
 * @property string $durationEditable
 * @property string $source
 * @property string $color
 * @property string $backgroundColor
 * @property string $borderColor
 * @property string $textColor
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end', 'entrega'], 'required'],
            [['start', 'end', 'entrega'], 'safe'],
            [['title', 'allDay', 'url', 'className', 'editable', 'startEditable', 'durationEditable', 'source', 'color', 'backgroundColor', 'borderColor', 'textColor'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'allDay' => Yii::t('app', 'All Day'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'entrega' => Yii::t('app', 'Entrega'),
            'url' => Yii::t('app', 'Url'),
            'className' => Yii::t('app', 'Class Name'),
            'editable' => Yii::t('app', 'Editable'),
            'startEditable' => Yii::t('app', 'Start Editable'),
            'durationEditable' => Yii::t('app', 'Duration Editable'),
            'source' => Yii::t('app', 'Source'),
            'color' => Yii::t('app', 'Color'),
            'backgroundColor' => Yii::t('app', 'Background Color'),
            'borderColor' => Yii::t('app', 'Border Color'),
            'textColor' => Yii::t('app', 'Text Color'),
        ];
    }
}
