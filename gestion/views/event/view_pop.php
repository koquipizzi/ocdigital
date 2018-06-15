<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'allDay',
            'start',
            'end',
            'url:url',
            'className',
            'editable',
            'startEditable',
            'durationEditable',
     //       'source',
     //       'color',
     //       'backgroundColor',
      //      'borderColor',
       //     'textColor',
        ],
    ]) ?>

</div>
