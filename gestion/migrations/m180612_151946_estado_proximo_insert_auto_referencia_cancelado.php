<?php

use yii\db\Migration;

/**
 * Class m180612_151946_estado_proximo_insert_auto_referencia_cancelado
 */
class m180612_151946_estado_proximo_insert_auto_referencia_cancelado extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->delete("estado_proximo",["estado_origen_id"=>5,"estado_destino_id"=>1]);
        $this->insert("estado_proximo",["estado_origen_id"=>5,"estado_destino_id"=>5]);
        $this->insert("estado_proximo",["estado_origen_id"=>5,"estado_destino_id"=>1]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("estado_proximo",["estado_origen_id"=>5,"estado_destino_id"=>5]);
    }
 
}
