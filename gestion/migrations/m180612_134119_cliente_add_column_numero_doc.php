<?php

use yii\db\Migration;

/**
 * Class m180612_134119_cliente_add_column_numero_doc
 */
class m180612_134119_cliente_add_column_numero_doc extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('cliente','documento',$this->integer()->null());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('cliente','documento');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180612_134119_cliente_add_column_numero_doc cannot be reverted.\n";

        return false;
    }
    */
}
