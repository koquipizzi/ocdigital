<?php

use yii\db\Migration;

/**
 * Class m180613_112627_rol_viajante_add_path_index_pendiente_viajante
 */
class m180613_112627_rol_viajante_add_path_index_pendiente_viajante extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert("auth_item", ["name"=>'/pedido/index_pendientes_viajante',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/index_pendientes_viajante"]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item_child",["parent"=>"Viajante","child"=>"/pedido/index_pendientes_viajante"]);
    
        $this->delete("auth_item",["parent"=>"Viajante","child"=>"/pedido/index_pendientes_viajante"]);
    }

    
}
