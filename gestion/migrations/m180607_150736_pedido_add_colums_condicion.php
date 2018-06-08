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
        $this->addColumn("pedido", "cond_venta", $this->string()->null());
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
    
        $this->dropColumn("pedido", "notas", $this->string()->null());
        $this->dropColumn("pedido", "cond_venta", $this->string()->null());
        $this->dropColumn("pedido", "telefono", $this->string()->null());
        $this->dropColumn("pedido", "responsable_recepcion", $this->string()->null());
        $this->dropColumn("pedido", "hora_de_recepción", $this->string()->null());
        $this->dropColumn("pedido", "gestor_id", $this->integer()->null());
        $this->dropForeignKey('fk_pedido_user_gestor_id','pedido');

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
