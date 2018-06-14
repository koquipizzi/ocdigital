<?php

use yii\db\Migration;

/**
 * Class m180614_200121_auth_item_y_auth_item_child_path_urls
 */
class m180614_200121_auth_item_y_auth_item_child_path_urls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert("auth_item", ["name"=>'/pedido/index_aceptados_viajante',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/index_aceptados_viajante"]);
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/index_aceptados_viajante"]);
        $this->delete("auth_item", ["name"=>'/pedido/index_aceptados_viajante',"type"=>2,"created_at"=>"1528818752","updated_at"=>"1528818752"]);
    
    }
}
