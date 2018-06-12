<?php

use yii\db\Migration;

/**
 * Class m180612_122130_pedido_add_column_estado_id
 */
class m180612_122130_pedido_add_column_estado_id extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn("pedido","estado_id",$this->integer(11)->defaultValue(1));
        
        $this->createIndex(
         'idx_pedido_estado-estado_id',
         'pedido',
         'estado_id'
        );
    
        $this->addForeignKey(
         'idx_pedido_estado-estado_id',
         'pedido',
         'estado_id',
         'estado',
         'id'
        );
    
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey(
         'idx_pedido_estado-estado_id',
         'pedido'
        );
    
        $this->dropIndex(
         'idx_pedido_estado-estado_id',
         'pedido'
        );
        
        $this->dropColumn("pedido","estado_id");
    }


}
