<?php

use yii\db\Migration;

/**
 * Class m180613_121359_paths_viajante
 */
class m180613_121359_paths_viajante extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/get-cliente-direccion"]);
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/producto/get-detalles"]);
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/site/index"]);
        
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/get-cliente-direccion"]);
        $this->delete("auth_item_child", ["parent"=>"Viajante","child"=>"/producto/get-detalles"]);
        $this->delete("auth_item_child", ["parent"=>"Viajante","child"=>"/site/index"]);
    
    }
    
}
