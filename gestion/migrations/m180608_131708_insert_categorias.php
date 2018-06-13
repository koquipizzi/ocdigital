<?php

use yii\db\Migration;

/**
 * Class m180608_131708_insert_categorias
 */
class m180608_131708_insert_categorias extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
           
         $this->execute("
         -- -----------------------------------------------------
            -- Data for table `categoria`
            -- -----------------------------------------------------
            INSERT INTO `categoria` ( `nombre`,web_id) VALUES ( 'Sin Categoría',24);
            INSERT INTO `categoria` ( `nombre`,web_id) VALUES ('Categoría 2',25);
            INSERT INTO `categoria` ( `nombre`,web_id) VALUES ('Categoría 3',23);
            INSERT INTO `categoria` ( `nombre`,`web_id`) VALUES ('Categoría 4',22);
            INSERT INTO `categoria` ( `nombre`,`web_id`) VALUES ('Categoría 5',26);
        ");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180608_131708_insert_categorias cannot be reverted.\n";

        $this->execute("
         delete * from `categoria` where id > 0;
        ");

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180608_131708_insert_categorias cannot be reverted.\n";

        return false;
    }
    */
}
