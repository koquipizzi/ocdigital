<?php

use yii\db\Migration;

/**
 * Class m180319_145811_nueva_categoria
 */
class m180319_145811_nueva_categoria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('categoria', [
            'id' => 6,
            'nombre' => 'Sin Categoria',
            'web_id' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('producto', ['id' => 6]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180319_145811_nueva_categoria cannot be reverted.\n";

        return false;
    }
    */
}
