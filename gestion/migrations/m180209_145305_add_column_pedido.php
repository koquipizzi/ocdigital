<?php

use yii\db\Migration;

/**
 * Class m180209_145305_add_columnp_pedido
 */
class m180209_145305_add_column_pedido extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn("pedido", "orden_reparto", $this->smallInteger(8) );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->dropColumn("pedido", "orden_reparto");
       // echo "m180209_145305_add_column_pedido cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180209_145305_add_columnp_pedido cannot be reverted.\n";

        return false;
    }
    */
}
