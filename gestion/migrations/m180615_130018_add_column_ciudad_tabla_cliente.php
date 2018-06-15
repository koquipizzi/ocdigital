<?php

use yii\db\Migration;

/**
 * Class m180615_130018_add_column_ciudad_tabla_cliente
 */
class m180615_130018_add_column_ciudad_tabla_cliente extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('cliente','ciudad',$this->string()->null());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('cliente','ciudad');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180615_130018_add_column_ciudad_tabla_cliente cannot be reverted.\n";

        return false;
    }
    */
}
