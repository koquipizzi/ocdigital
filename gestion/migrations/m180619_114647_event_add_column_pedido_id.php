<?php

use yii\db\Migration;

/**
 * Class m180619_114647_event_add_column_pedido_id
 */
class m180619_114647_event_add_column_pedido_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("event","pedido_id",$this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("event","pedido_id");
    }

    
}
