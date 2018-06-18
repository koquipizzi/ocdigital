<?php
use mdm\admin\components\Helper;
use yii\helpers\Url;

$this->registerJs('var ajaxHome = "' .Url::to(['pedido/cantidad']). '";', \yii\web\View::POS_HEAD);
$js = 'function refresh() {
        $.ajax({
            url: ajaxHome,
            success: function(data) {
            $("#cant").html(data.pendientes);
            $("#canta").html(data.aceptados);
            $("#cante").html(data.expedicion);
            $("#cantc").html(data.cancelados);
            $("#cantt").html(data.todos);
            }
        });
      //  $.pjax.reload({container:"#cant"});
        setTimeout(refresh, 50000); // restart the function every 5 seconds
        }
        refresh();';

 $this->registerJs($js, $this::POS_READY);
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!--img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/-->
                 <img src="<?= Yii::$app->getHomeUrl().'images/fp_logo.jpg' ?>" alt="admin" class="img-circle">
            </div>
            <div class="pull-left info">
                <p><?php // $user = \app\models\User::find()->where(['=', 'id', Yii::$app->user->id])->one(); echo $user->username;  ?></p>
                <p><?php //$user = \app\models\User::find()->where(['=', 'id', Yii::$app->user->id])->one(); echo $user->username;  ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php
            $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
            $cant_pedidos = '<span class="pull-right-container"><small class="label pull-right bg-red"><div id="cant">
            </div></small></span>';
             $cant_pedidos_a = '<span class="pull-right-container"><small class="label pull-right bg-orange"><div id="canta">
            </div></small></span>';
             $cant_pedidos_e = '<span style="border-left: 12px;" class="pull-right-container"><small class="label pull-right bg-blue"><div id="cante">
            </div></small></span>';
             $cant_pedidos_d = '<span class="pull-right-container"><small class="label pull-right bg-teal"><div id="cantd">
            </div></small></span>';
             $cant_pedidos_c = '<span class="pull-right-container"><small class="label pull-right bg-red"><div id="cantc">
            </div></small></span>';
            $cant_pedidos_t = '<span class="pull-right-container"><small class="label pull-right bg-red"><div id="cantt">
            </div></small></span>';
            
            if ( current($userRole)->name != 'Viajante'){
                echo dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                        'items' =>
                            [
                                ['label' => 'Panel de Control', 'icon' => 'tachometer', 'url' => ['/']],
                                ['label' => 'Pedidos Pendientes', 'icon' =>  'clock-o', 'url' => ['/pedido/index_pendientes'], 'template'=>'<a href="{url}">{icon} {label}'.$cant_pedidos.'</a>'],
                                ['label' => 'Pedidos Aceptados', 'icon' =>  'check-square-o', 'url' => ['/pedido/index_aceptados'] ,'template'=>'<a href="{url}">{icon} {label}'.$cant_pedidos_a.'</a>'],
                                ['label' => 'Pedidos Expedición', 'icon' =>  'rocket', 'url' => ['/pedido/index_expedicion'],  'template'=>'<a href="{url}">{icon} {label}'.$cant_pedidos_e.'</a>'],
                                ['label' => 'Pedidos Cancelados', 'icon' =>  'close', 'url' => ['/pedido/index_cancelados'],  'template'=>'<a href="{url}">{icon} {label}'.$cant_pedidos_c.'</a>'],
                                ['label' => 'Todos los Pedidos', 'icon' =>  'server', 'url' => ['/pedido/index_todos'],  'template'=>'<a href="{url}">{icon} {label} '.$cant_pedidos_t.'</a>'],
                                ['label' => 'Crear Pedido', 'class' => 'text-yellow', 'icon' =>  'plus', 'url' => ['/pedido/create'], 'options' => ['class' => 'bg-yellow color-palette']],
                                ['label' => 'Clientes', 'icon' => ' fa-user', 'url' => ['/cliente/index']],
                                ['label' => 'Productos', 'icon' => 'shopping-basket', 'url' => ['/producto/index']],
                                [
                                    'label' => 'Configuración',
                                    'icon' => 'cogs',
                                    'url' => '#',
                                    'items' =>
                                        [
                                            ['label' => 'Mails de Alertas', 'icon' => 'envelope-o', 'url' => ['/mail/index']],
                                            ['label' => 'Auditoría', 'icon' => 'check-circle', 'url' => ['/pedido/audit']],
                                            ['label' => 'Unidades', 'icon' => 'fa fa-add', 'url' => ['/unidad/index']],
                                        ],
                                ],
                            ]
                    ]
                );
            }else{
                echo dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                        'items' =>
                            [
                                ['label' => 'Pedidos Pendientes', 'icon' =>  'clock-o', 'url' => ['/pedido/index_pendientes_viajante']],
                                ['label' => 'Pedidos Aceptados', 'icon' =>  'check-square-o', 'url' => ['/pedido/index_aceptados_viajante']],
                                ['label' => 'Todos los Pedidos', 'icon' =>  'server', 'url' => ['/pedido/index_todos_viajante']],
                                ['label' => 'Crear Pedido', 'icon' =>  'plus', 'url' => ['/pedido/create'], 'options' => ['class' => 'bg-yellow color-palette']]
                            ]
                    ]);
            }
            ?>
    </section>
</aside>
