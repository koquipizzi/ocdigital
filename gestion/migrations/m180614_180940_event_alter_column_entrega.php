<?php

use yii\db\Migration;

/**
 * Class m180614_180940_event_alter_column_entrega
 */
class m180614_180940_event_alter_column_entrega extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn("event","entrega",$this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn("event","entrega",$this->dateTime()->notNull());
    }

    
}
