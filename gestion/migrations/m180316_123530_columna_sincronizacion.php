<?php

use yii\db\Migration;

/**
 * Class m180316_123530_columna_sincronizacion
 */
class m180316_123530_columna_sincronizacion extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pedido', 'sync', 'INT DEFAULT 0');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pedido', 'sync');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180316_123530_columna_sincronizacion cannot be reverted.\n";

        return false;
    }
    */
}
