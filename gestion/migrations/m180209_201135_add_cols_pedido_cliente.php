<?php

use yii\db\Migration;

class m180209_201135_add_cols_pedido_cliente extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn("cliente", "contacto", $this->string() );
        $this->addColumn("cliente", "telefono", $this->string() );
        $this->addColumn("cliente", "hora_reparto", $this->string() );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->dropColumn("cliente", "contacto");
        $this->dropColumn("cliente", "telefono");
        $this->dropColumn("cliente", "hora_reparto");
        echo "m180209_145305_add_column_pedido was reverted.\n";

        return true;
    }
}
