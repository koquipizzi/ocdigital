<?php

use yii\db\Migration;

/**
 * Class m180606_174911_producto_add_atributo_codigo
 */
class m180606_174911_producto_add_atributo_codigo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->addColumn("producto","codigo",$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("producto","codigo");
    }

    
    
}
