<?php

use yii\db\Migration;

/**
 * Class m180606_175648_producto_add_column_codigo_producto
 */
class m180606_175648_producto_add_column_codigo_producto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->addColumn("producto","codigo_nombre_producto",$this->string());
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("producto","codigo_nombre_producto");
    }
    
}
