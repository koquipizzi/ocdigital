<?php

use yii\db\Migration;

/**
 * Class m180619_123810_rol_viajante_add_path_pedido_delete
 */
class m180619_123810_rol_viajante_add_path_pedido_delete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/delete"]);
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item", ["name"=>'/pedido/delete',"type"=>2]);
    }
    
}
