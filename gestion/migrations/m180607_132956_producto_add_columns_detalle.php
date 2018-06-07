<?php

use yii\db\Migration;

/**
 * Class m180607_132956_producto_add_columns_detalle
 */
class m180607_132956_producto_add_columns_detalle extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('unidad',[
            'id' =>  $this->integer()->notNull(),
            'nombre_unidad' =>  $this->string()->notNull()
        ]);
        
        $this->addPrimaryKey('pk_unidad_id','unidad','id');
        
        $this->addColumn("pedido_detalle", "unidad_id", $this->integer()->null());
        $this->addColumn("pedido_detalle", "precio_unitario", $this->float(2)->null());
        $this->addForeignKey('fk_pedido_detalle_unidad_unidad_id','pedido_detalle','unidad_id','unidad','id');
        
        $this->alterColumn("producto", "unidad_id", $this->integer()->null());
        $this->addForeignKey('fk_produto_unidad_id','producto','unidad_id','unidad','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180607_132956_producto_add_columns_detalle cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180607_132956_producto_add_columns_detalle cannot be reverted.\n";

        return false;
    }
    */
}
