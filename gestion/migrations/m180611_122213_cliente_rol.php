<?php

use yii\db\Migration;

/**
 * Class m180611_122213_cliente_rol
 */
class m180611_122213_cliente_rol extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('cliente_rol',['cliente_id' => 1,'rol_id' => 1 ]);
        $this->insert('cliente_rol',['cliente_id' => 2,'rol_id' => 1 ]);
        $this->insert('cliente_rol',['cliente_id' => 3,'rol_id' => 1 ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('cliente_rol',['cliente_id' => 1,'rol_id' => 1 ]);
        $this->delete('cliente_rol',['cliente_id' => 2,'rol_id' => 1 ]);
        $this->delete('cliente_rol',['cliente_id' => 3,'rol_id' => 1 ]);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180611_122213_cliente_rol cannot be reverted.\n";

        return false;
    }
    */
}
