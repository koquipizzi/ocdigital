<?php

use yii\db\Migration;

/**
 * Class m180612_182700_rol_viajante_add_path_index_aceptados
 */
class m180612_182700_rol_viajante_add_path_index_aceptados extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/index_aceptados"]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item_child",["parent"=>"Viajante","child"=>"/pedido/index_aceptados"]);
    }
    
}
