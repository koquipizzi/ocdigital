<?php

use yii\db\Migration;

/**
 * Class m180607_185034_create_table_estado
 */
class m180607_185034_create_table_estado extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->createTable('estado', [
         'id' => $this->primaryKey()->notNull(),
         'descripcion' => $this->string(45)->notNull(),
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("estado");
    }
}
