<?php

use yii\db\Migration;

/**
 * Class m180614_195716_auth_item_y_auth_item_child_path_index_todos
 */
class m180614_195716_auth_item_y_auth_item_child_path_index_todos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert("auth_item", ["name"=>'/pedido/index_todos',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
        $this->insert("auth_item_child", ["parent"=>"Gerente","child"=>"/pedido/index_todos"]);
        $this->insert("auth_item_child", ["parent"=>"Logistica","child"=>"/pedido/index_todos"]);
        $this->insert("auth_item_child", ["parent"=>"Administrador","child"=>"/pedido/index_todos"]);
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item_child", ["parent"=>"Gerente","child"=>"/pedido/index_todos"]);
        $this->delete("auth_item_child", ["parent"=>"Logistica","child"=>"/pedido/index_todos"]);
        $this->delete("auth_item_child", ["parent"=>"Administrador","child"=>"/pedido/index_todos"]);
        $this->delete("auth_item", ["name"=>'/pedido/index_todos',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
    
    }
 
}
