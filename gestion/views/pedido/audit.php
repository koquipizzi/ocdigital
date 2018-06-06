<?php
use bedezign\yii2\audit\Audit;
use yii\helpers\Html;
use yii\grid\GridView;
use bedezign\yii2\audit\models\AuditTrailSearch;
use bedezign\yii2\audit\models\AuditEntrySearch;
use yii\helpers\ArrayHelper;
use app\models\User;

use bedezign\yii2\audit\components\Access;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('audit', 'Auditoría - Entradas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Configuracion'), 'url' => ['/site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-warning">
        <div class="box-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
        //   'filterModel' =>  $searchModel,
            'columns' => [
            // ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
            // 'id',
                [
                    'attribute' => 'user_id',
                //   'filter' => AuditEntrySearch::userFilter(),
                    'label' => 'Usuarios',
                    'class' => 'yii\grid\DataColumn',
                    'value' => function ($data) {
                        $user = User::find()->where(['id' => $data->user_id])->one();
                        if (!empty($user))
                            return $user->username;
                        return "";
                    },
                    'format' => 'raw',
                ],
                'ip',
                
                [
                    'class' => 'yii\grid\DataColumn',
                    'attribute' => 'route',
                    'label' => 'Lugar De Entrada',
                //    'filter' => AuditEntrySearch::routeFilter(),
                    'format' => 'html',
                    'value' => function ($data) {
                        return HTML::tag('span', '', [
                            'title' => \yii\helpers\Url::to([$data->route]),
                            'class' => 'glyphicon glyphicon-link'
                        ]) . ' ' . $data->route;
                    },
                ],
                
                [
                    'attribute' => 'trails',
                    'label' => 'Accion BD',
                    'format' => 'html',
            //       'filter' => AuditTrailSearch::actionFilter(),
                    'value' => function ($data) {
                        return $this->render('@bedezign/yii2/audit/views/_audit_entry_id', ['style' => '']); 
                        if ($auditEntry = Audit::getInstance()->getEntry()) {
                            if (!isset($style)) {
                                $style = YII_DEBUG ? '' : 'color:transparent;';
                            }
                            if (Access::checkAccess()) {
                                return Html::a('audit-' . $auditEntry->id, ['/audit/entry/view', 'id' => $auditEntry->id], ['style' => $style]);
                            } else {
                                return Html::tag('span', 'audit-' . $auditEntry->id, ['style' => $style]);
                            }
                        }
                //  return $data->trails ? $data->trails[0]['action'] : '';
                    },
                    'contentOptions' => ['class' => 'text-right'],
                ],
            
                
                
                [
                    'attribute' => 'created',
                    'label' => 'Fecha',
                    'options' => ['width' => '150px'],
                ],
            ],
        ]); ?>
        </div>
    </div>
