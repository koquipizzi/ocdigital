<?php
use mdm\admin\components\Helper;
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
            
            if ( current($userRole)->name != 'Viajante'){
                echo dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                        'items' =>
                            [
                                ['label' => 'Gestión de Comandas', 'options' => ['class' => 'header']],
                                ['label' => 'Panel de Control', 'icon' => 'tachometer', 'url' => ['/']],
                                ['label' => 'Pedidos Pendientes', 'icon' =>  'clock-o', 'url' => ['/pedido/index_pendientes']],
                                ['label' => 'Pedidos Aceptados', 'icon' =>  'clock-o', 'url' => ['/pedido/index_aceptados']],
                                ['label' => 'Pedidos En Expedición', 'icon' =>  'clock-o', 'url' => ['/pedido/index_expedicion']],
                                ['label' => 'Pedidos Despachados', 'icon' =>  'clock-o', 'url' => ['/pedido/index_despachados']],
                                ['label' => 'Pedidos Cancelados', 'icon' =>  'clock-o', 'url' => ['/pedido/index_cancelados']],
                                //['label' => 'Pedidos Históricos', 'icon' => 'history', 'url' => ['/pedido/index']],
                                ['label' => 'Crear Pedido', 'icon' =>  'plus', 'url' => ['/pedido/create']],
                                ['label' => 'Clientes', 'icon' => ' fa-user', 'url' => ['/cliente/index']],
                                ['label' => 'Productos', 'icon' => 'shopping-basket', 'url' => ['/producto/index']],
                                //['label' => 'Productos Pendientes', 'icon' => 'clock-o', 'url' => ['/producto/pindex']],
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
                                ['label' => 'Pedidos Pendientes', 'icon' =>  'clock-o', 'url' => ['/pedido/index_pendientes']],
                                ['label' => 'Pedidos Aceptados', 'icon' =>  'clock-o', 'url' => ['/pedido/index_aceptados']],
                                ['label' => 'Crear Pedido', 'icon' =>  'plus', 'url' => ['/pedido/create']],
                            ]
                    ]);
            }
            ?>
    </section>
</aside>
