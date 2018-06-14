<?php

use yii\db\Migration;

/**
 * Class m180611_113837_cliente_add_column_codigo
 */
class m180611_113837_cliente_add_column_codigo extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('cliente','codigo',$this->string()->null());
        $this->addColumn('cliente','codigo_nombre_cliente',$this->string()->null());
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('cliente','codigo');
        $this->dropColumn('cliente','codigo_nombre_cliente');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180611_113837_cliente_add_column_codigo cannot be reverted.\n";

        return false;
    }
    */
}
