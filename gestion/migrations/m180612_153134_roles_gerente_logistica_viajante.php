<?php

use yii\db\Migration;

/**
 * Class m180612_153134_roles_gerente_logistica_viajante
 */
class m180612_153134_roles_gerente_logistica_viajante extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->execute("
        INSERT INTO `auth_item` VALUES ('/admin/*',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/assignment/*',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/assignment/assign',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/assignment/index',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/assignment/revoke',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/assignment/view',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/default/*',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/default/index',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/menu/*',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/menu/create',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/menu/delete',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/menu/index',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/menu/update',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/menu/view',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/*',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/assign',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/create',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/delete',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/index',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/remove',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/update',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/permission/view',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/*',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/assign',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/create',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/delete',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/index',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/remove',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/update',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/role/view',2,NULL,NULL,NULL,1528818751,1528818751),('/admin/route/*',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/route/assign',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/route/create',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/route/index',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/route/refresh',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/route/remove',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/rule/*',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/rule/create',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/rule/delete',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/rule/index',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/rule/update',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/rule/view',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/*',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/activate',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/change-password',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/delete',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/index',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/login',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/logout',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/reset-password',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/signup',2,NULL,NULL,NULL,1528818752,1528818752),('/admin/user/view',2,NULL,NULL,NULL,1528818752,1528818752),('/audit/*',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/default/*',2,NULL,NULL,NULL,1528818748,1528818748),('/audit/default/index',2,NULL,NULL,NULL,1528818748,1528818748),('/audit/entry/*',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/entry/db-explain',2,NULL,NULL,NULL,1528818748,1528818748),('/audit/entry/index',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/entry/view',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/error/*',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/error/index',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/error/view',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/javascript/*',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/javascript/index',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/javascript/view',2,NULL,NULL,NULL,1528818749,1528818749),('/audit/js-log/*',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/js-log/index',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/mail/*',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/mail/download',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/mail/index',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/mail/view',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/mail/view-html',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/trail/*',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/trail/index',2,NULL,NULL,NULL,1528818750,1528818750),('/audit/trail/view',2,NULL,NULL,NULL,1528818750,1528818750),('/categoria/*',2,NULL,NULL,NULL,1528818753,1528818753),('/categoria/create',2,NULL,NULL,NULL,1528818753,1528818753),('/categoria/delete',2,NULL,NULL,NULL,1528818753,1528818753),('/categoria/index',2,NULL,NULL,NULL,1528818753,1528818753),('/categoria/update',2,NULL,NULL,NULL,1528818753,1528818753),('/categoria/view',2,NULL,NULL,NULL,1528818753,1528818753),('/cliente/*',2,NULL,NULL,NULL,1528818754,1528818754),('/cliente/create',2,NULL,NULL,NULL,1528818753,1528818753),('/cliente/create-web',2,NULL,NULL,NULL,1528818754,1528818754),('/cliente/delete',2,NULL,NULL,NULL,1528818754,1528818754),('/cliente/edit-email',2,NULL,NULL,NULL,1528818753,1528818753),('/cliente/index',2,NULL,NULL,NULL,1528818753,1528818753),('/cliente/update',2,NULL,NULL,NULL,1528818754,1528818754),('/cliente/view',2,NULL,NULL,NULL,1528818753,1528818753),('/comanda-detalle/*',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda-detalle/create',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda-detalle/delete',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda-detalle/index',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda-detalle/update',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda-detalle/view',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/*',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/alter-comanda',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/asignar-comanda',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/create',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/delete',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/get-action',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/imprimir-comandas',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/imprimir-logistica',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/imprimircat-comandas',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/index',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/new-comanda',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/update',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/view',2,NULL,NULL,NULL,1528818754,1528818754),('/comanda/view-pedidos',2,NULL,NULL,NULL,1528818754,1528818754),('/comment/*',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/comments/*',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/comments/delete',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/comments/index',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/comments/update',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/default/*',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/default/create',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/default/delete',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/default/quick-edit',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/manage/*',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/manage/delete',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/manage/index',2,NULL,NULL,NULL,1528818750,1528818750),('/comment/manage/update',2,NULL,NULL,NULL,1528818750,1528818750),('/datecontrol/*',2,NULL,NULL,NULL,1528818753,1528818753),('/datecontrol/parse/*',2,NULL,NULL,NULL,1528818753,1528818753),('/datecontrol/parse/convert',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/*',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/default/*',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/default/db-explain',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/default/download-mail',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/default/index',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/default/toolbar',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/default/view',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/user/*',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/user/reset-identity',2,NULL,NULL,NULL,1528818753,1528818753),('/debug/user/set-identity',2,NULL,NULL,NULL,1528818753,1528818753),('/domicilio/*',2,NULL,NULL,NULL,1528818755,1528818755),('/domicilio/create',2,NULL,NULL,NULL,1528818755,1528818755),('/domicilio/delete',2,NULL,NULL,NULL,1528818755,1528818755),('/domicilio/index',2,NULL,NULL,NULL,1528818754,1528818754),('/domicilio/update',2,NULL,NULL,NULL,1528818755,1528818755),('/domicilio/view',2,NULL,NULL,NULL,1528818755,1528818755),('/event/*',2,NULL,NULL,NULL,1528818755,1528818755),('/event/create',2,NULL,NULL,NULL,1528818755,1528818755),('/event/delete',2,NULL,NULL,NULL,1528818755,1528818755),('/event/index',2,NULL,NULL,NULL,1528818755,1528818755),('/event/update',2,NULL,NULL,NULL,1528818755,1528818755),('/event/view',2,NULL,NULL,NULL,1528818755,1528818755),('/event/viewpop',2,NULL,NULL,NULL,1528818755,1528818755),('/gii/*',2,NULL,NULL,NULL,1528818753,1528818753),('/gii/default/*',2,NULL,NULL,NULL,1528818753,1528818753),('/gii/default/action',2,NULL,NULL,NULL,1528818753,1528818753),('/gii/default/diff',2,NULL,NULL,NULL,1528818753,1528818753),('/gii/default/index',2,NULL,NULL,NULL,1528818753,1528818753),('/gii/default/preview',2,NULL,NULL,NULL,1528818753,1528818753),('/gii/default/view',2,NULL,NULL,NULL,1528818753,1528818753),('/mail/*',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/add',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/borrar',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/create',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/delete',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/edit',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/index',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/update',2,NULL,NULL,NULL,1528818755,1528818755),('/mail/view',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido-detalle/*',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido-detalle/create',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido-detalle/delete',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido-detalle/index',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido-detalle/update',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido-detalle/view',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/*',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/audit',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/bajar',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/confirm',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/delete',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/edit-cliente',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/edit-cliente-hora-entrega',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/edit-telefono',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/get-cliente-direccion',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/hindex',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido/index_aceptados',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido/index_cancelados',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido/index_despachados',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido/index_expedicion',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido/index_pendientes',2,NULL,NULL,NULL,1528818755,1528818755),('/pedido/print',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/quitar-comanda',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/subir',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/sync',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/syncmaxirest',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/update',2,NULL,NULL,NULL,1528818756,1528818756),('/pedido/view',2,NULL,NULL,NULL,1528818756,1528818756),('/producto/*',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/create',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/delete',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/get-detalles',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/index',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/pindex',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/quitar-producto',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/setrol',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/sync',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/update',2,NULL,NULL,NULL,1528818757,1528818757),('/producto/view',2,NULL,NULL,NULL,1528818757,1528818757),('/rol/*',2,NULL,NULL,NULL,1528818757,1528818757),('/rol/create',2,NULL,NULL,NULL,1528818757,1528818757),('/rol/delete',2,NULL,NULL,NULL,1528818757,1528818757),('/rol/index',2,NULL,NULL,NULL,1528818757,1528818757),('/rol/update',2,NULL,NULL,NULL,1528818757,1528818757),('/rol/view',2,NULL,NULL,NULL,1528818757,1528818757),('/site/*',2,NULL,NULL,NULL,1528818758,1528818758),('/site/about',2,NULL,NULL,NULL,1528818757,1528818757),('/site/captcha',2,NULL,NULL,NULL,1528818757,1528818757),('/site/contact',2,NULL,NULL,NULL,1528818757,1528818757),('/site/error',2,NULL,NULL,NULL,1528818757,1528818757),('/site/index',2,NULL,NULL,NULL,1528818757,1528818757),('/site/login',2,NULL,NULL,NULL,1528818757,1528818757),('/unidad/*',2,NULL,NULL,NULL,1528818758,1528818758),('/unidad/create',2,NULL,NULL,NULL,1528818758,1528818758),('/unidad/delete',2,NULL,NULL,NULL,1528818758,1528818758),('/unidad/index',2,NULL,NULL,NULL,1528818758,1528818758),('/unidad/update',2,NULL,NULL,NULL,1528818758,1528818758),('/unidad/view',2,NULL,NULL,NULL,1528818758,1528818758),('/user/*',2,NULL,NULL,NULL,1528818758,1528818758),('/user/create',2,NULL,NULL,NULL,1528818758,1528818758),('/user/delete',2,NULL,NULL,NULL,1528818758,1528818758),('/user/image-delete',2,NULL,NULL,NULL,1528818758,1528818758),('/user/index',2,NULL,NULL,NULL,1528818758,1528818758),('/user/update',2,NULL,NULL,NULL,1528818758,1528818758),('/user/view',2,NULL,NULL,NULL,1528818758,1528818758);
");
        $this->execute(
            '
            
                -- ------------------------------------------
                -- insert acciones faltantes  rol Viajante
                -- ------------------------------------------
                
                INSERT INTO `auth_item_child`
                VALUES
                 ("Viajante","/datecontrol/*"),
                 ("Viajante","/pedido/view"),
                 ("Viajante","/pedido/update");
                
                
                
                -- ------------------------------------------
                -- insert acciones para el rol gerente
                -- ------------------------------------------
                
                INSERT INTO auth_item (name,type)  values("Gerente",1);
                
                INSERT INTO `auth_item_child`
                 VALUES
                 (
                    "Gerente",
                    "/*"
                 );
                
                
                -- gerente!
                INSERT INTO  `user`
                (
                    `username`,
                    `password_hash`,
                    `status`
                 )
                VALUES
                (
                    "Gerente",
                    "$2y$10$EjA67mbBoEWTypjOsIPXa.t2jMMM9SLjVNECL3cq/iR.l2CcZfJdC"
                    ,1
                 );
                
                INSERT INTO  `auth_assignment`
                (
                    `item_name`,
                    `user_id`
                )
                VALUES
                (
                    "Gerente",
                    9
                );
                
                -- ------------------------------------------
                -- insert acciones para el rol Logistica
                -- ------------------------------------------
                insert into auth_item(name,type) values ("Logistica",1);
                
                INSERT INTO `auth_item_child`
                    VALUES
                 (
                    "Logistica",
                    "/*"
                 );
                
                
                -- logistica!321
                INSERT INTO  `user`
                (
                    `username`,
                    `password_hash`,
                    `status`
                 )
                VALUES
                (
                    "Logistica",
                    "$2y$10$TrkjYze3CA7cus5Mr3F1F.OfkFm5/l76TD4uOZMeN/kBmv2cvUUry"
                    ,1
                );
                
                INSERT INTO  `auth_assignment`
                (
                    `item_name`,
                    `user_id`
                )
                VALUES
                (
                    "Logistica",
                    10
                );

            '
         );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }

 
}
