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
       // $this->alterColumn('unidad', 'id', $this->integer(8).' NOT NULL AUTO_INCREMENT');
       
        $this->addColumn("producto", "unidad_id", $this->integer()->null());
        $this->addColumn("pedido_detalle", "unidad_id", $this->integer()->null());
        $this->addColumn("pedido_detalle", "precio_unitario", $this->float(2)->null());      
        

       
        $this->createIndex('idx_unidad_id','unidad','id');
        $this->addForeignKey('fk_pedido_detalle_unidad_unidad_id','pedido_detalle','unidad_id','unidad','id');
        $this->addForeignKey('fk_producto_unidad_id','producto','unidad_id','unidad','id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    
        $this->dropIndex('idx_unidad_id','unidad');
        $this->dropPrimaryKey('pk_unidad_id','unidad');
    
        $this->dropColumn("pedido_detalle", "unidad_id", $this->integer()->null());
        $this->dropColumn("pedido_detalle", "precio_unitario", $this->float(2)->null());
    
        $this->dropColumn("producto", "unidad_id", $this->integer()->null());
        
        $this->dropTable('unidad');


        return true;
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
