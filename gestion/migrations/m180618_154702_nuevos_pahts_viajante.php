<?php

use yii\db\Migration;

/**
 * Class m180618_154702_nuevos_pahts_viajante
 */
class m180618_154702_nuevos_pahts_viajante extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert("auth_item", ["name"=>'/pedido/pedidos-realizados',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/pedidos-realizados"]);
        $this->insert("auth_item", ["name"=>'/pedido/cantidad',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/cantidad"]);

    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->delete("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/pedidos-realizados"]);
        $this->delete("auth_item", ["name"=>'/pedido/pedidos-realizados',"type"=>2]);
    
        $this->delete("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/cantidad"]);
        $this->delete("auth_item", ["name"=>'/pedido/cantidad',"type"=>2]);
        
    }
 
}
