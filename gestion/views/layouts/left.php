<?php
use mdm\admin\components\Helper;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!--img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/-->
                 <img src="<?= Yii::$app->getHomeUrl().'images/prospero_logo.jpg' ?>" alt="admin" class="img-circle">
            </div>
            <div class="pull-left info">
                <p><?php // $user = \app\models\User::find()->where(['=', 'id', Yii::$app->user->id])->one(); echo $user->username;  ?></p>
                <p><?php //$user = \app\models\User::find()->where(['=', 'id', Yii::$app->user->id])->one(); echo $user->username;  ?></p>


                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?php echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                'items' =>
                [
                    ['label' => 'Gestión de Comandas', 'options' => ['class' => 'header']],
                    ['label' => 'Panel de Control', 'icon' => 'tachometer', 'url' => ['/']],
                    ['label' => 'Pedidos Pendientes', 'icon' =>  'clock-o', 'url' => ['/pedido/index']],
                    ['label' => 'Pedidos Históricos', 'icon' => 'history', 'url' => ['/pedido/hindex']],
                    ['label' => 'Pedido Manual', 'icon' =>  'plus', 'url' => ['/pedido/create']],
                    //['label' => 'Comandas', 'icon' => 'cutlery', 'url' => ['/comanda/index']],
                    ['label' => 'Clientes', 'icon' => ' fa-user', 'url' => ['/cliente/index']],
                    ['label' => 'Productos', 'icon' => 'shopping-basket', 'url' => ['/producto/index']],
                    ['label' => 'Productos Pendientes', 'icon' => 'clock-o', 'url' => ['/producto/pindex']],
                    [
                    'label' => 'Configuración',
                    'icon' => 'cogs',
                    'url' => '#',
                    'items' =>
                        [
                            ['label' => 'Mails de Alertas', 'icon' => 'envelope-o', 'url' => ['/mail/index']],
                            ['label' => 'Auditoría', 'icon' => 'check-circle', 'url' => ['/pedido/audit']],
                            ['label' => 'Agregar Unidades', 'icon' => 'fa fa-add', 'url' => ['/unidad/agregar']],
                        ],
                    ],
                ]
            ]
        ) ?>

    </section>
</aside>
