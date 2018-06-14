<?php

use yii\db\Migration;

/**
 * Class m180614_120520_estado_proximo_eliminar_despacho
 */
class m180614_120520_estado_proximo_eliminar_despacho extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete("estado_proximo",["estado_origen_id"=>3,"estado_destino_id"=>4]);
        $this->delete("estado_proximo",["estado_origen_id"=>4]);
        $this->dropForeignKey("idx_pedido_estado-estado_id","pedido");
        $this->execute("
                delete from workflow
                where estado_id=4;
        ");
        $this->delete("estado",["id"=>4]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->insert("estado",["id"=>4,"descripcion"=>"Despachado"]);
        $this->insert("estado_proximo",["estado_origen_id"=>4,"estado_destino_id"=>4]);
        $this->insert("estado_proximo",["estado_origen_id"=>4,"estado_destino_id"=>5]);
        $this->insert("estado_proximo",["estado_origen_id"=>3,"estado_destino_id"=>4]);
        $this->addForeignKey(
         'idx_pedido_estado-estado_id',
         'pedido',
         'estado_id',
         'estado',
         'id'
        );
        
    }

}
