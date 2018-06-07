<?php

use yii\db\Migration;

/**
 * Class m180607_150736_pedido_add_colums_condicion
 */
class m180607_150736_pedido_add_colums_condicion extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn("pedido", "notas", $this->string()->null());
        $this->addColumn("pedido", "telefono", $this->string()->null());
        $this->addColumn("pedido", "responsable_recepcion", $this->string()->null());
        $this->addColumn("pedido", "hora_de_recepción", $this->string()->null());
        $this->addColumn("pedido", "gestor_id", $this->integer()->null());
        $this->addForeignKey('fk_pedido_user_gestor_id','pedido','gestor_id','user','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180607_150736_pedido_add_colums_condicion cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180607_150736_pedido_add_colums_condicion cannot be reverted.\n";

        return false;
    }
    */
}
