<?php

use yii\db\Migration;

/**
 * Class m180612_180806_rol_viajante_add_path_index_pendientes
 */
class m180612_180806_rol_viajante_add_path_index_pendientes extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert("auth_item_child", ["parent"=>"Viajante","child"=>"/pedido/index_pendientes"]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_item_child",["parent"=>"Viajante","child"=>"/pedido/index_pendientes"]);
    }

  
}
