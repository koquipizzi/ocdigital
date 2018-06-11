<?php

use yii\db\Migration;

/**
 * Class m180611_214536_estadoProximo_inserts
 */
class m180611_214536_estadoProximo_inserts extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->delete("estado_proximo","id>0");
        $this->insert("estado_proximo",["estado_origen_id"=>1,"estado_destino_id"=>2]);
        $this->insert("estado_proximo",["estado_origen_id"=>1,"estado_destino_id"=>5]);
        $this->insert("estado_proximo",["estado_origen_id"=>2,"estado_destino_id"=>3]);
        $this->insert("estado_proximo",["estado_origen_id"=>2,"estado_destino_id"=>5]);
        $this->insert("estado_proximo",["estado_origen_id"=>3,"estado_destino_id"=>4]);
        $this->insert("estado_proximo",["estado_origen_id"=>3,"estado_destino_id"=>5]);
        $this->insert("estado_proximo",["estado_origen_id"=>4,"estado_destino_id"=>5]);
        $this->insert("estado_proximo",["estado_origen_id"=>5,"estado_destino_id"=>1]);
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("estado_proximo","id>0");
    }

    
}
