<?php

use yii\db\Migration;

/**
 * Class m171215_195737_alter_user_table
 */
class m171215_195737_alter_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn("user", "auth_key", $this->string()->null());
        $this->alterColumn("user", "email", $this->string()->null());
        $this->alterColumn("user", "created_at", $this->integer()->null());
        $this->alterColumn("user", "updated_at", $this->integer()->null());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171215_195737_alter_user_table cannot be reverted.\n";

        $this->alterColumn("user", "auth_key", $this->string()->notNull());
        $this->alterColumn("user", "email", $this->string()->notNull());
        $this->alterColumn("user", "created_at", $this->integer()->notNull());
        $this->alterColumn("user", "updated_at", $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171215_195737_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
