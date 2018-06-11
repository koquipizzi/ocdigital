<?php

use yii\db\Migration;

/**
 * Class m180607_193041_estado_insert_estados
 */
class m180607_193041_estado_insert_estados extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert("estado",["descripcion"=>"Pendiente"]);
        $this->insert("estado",["descripcion"=>"Aceptado"]);
        $this->insert("estado",["descripcion"=>"Expedición"]);
        $this->insert("estado",["descripcion"=>"Despacho"]);
        $this->insert("estado",["descripcion"=>"Cancelado"]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->delete("estado","id>0");
    }
    
}
