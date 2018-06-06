<?php

use yii\db\Migration;

/**
 * Class m180215_152937_confirmacion_pedido
 */
class m180215_152937_confirmacion_pedido extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('pedido', 'confirmado', 'INT DEFAULT 0');
        $this->addColumn('pedido', 'facturable', 'INT DEFAULT 0');
        $this->addColumn('pedido', 'flete_bonificado', 'INT DEFAULT 1');
        $this->addColumn('pedido', 'flete_valor', 'DECIMAL(8,2) DEFAULT 0');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('pedido', 'confirmado');
        $this->dropColumn('pedido', 'facturable');
        $this->dropColumn('pedido', 'flete_bonificado');
        $this->dropColumn('pedido', 'flete_valor');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180215_152937_confirmacion_pedido cannot be reverted.\n";

        return false;
    }
    */
}
