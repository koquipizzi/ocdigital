<?php

use yii\db\Migration;

/**
 * Class m171221_115305_add_admin_users
 */
class m171221_115305_add_admin_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {


        $this->execute("
            insert into auth_item (name,type)
            select * from (select '/*',2 ) as tmp
            where not EXISTS (
            SELECT 1 FROM `auth_item` WHERE name='/*' and type=2
            )LIMIT 1;
            ");

        $this->execute("
            insert into auth_item (name,type)
            select * from (select 'Administrador',1 ) as tmp
            where not EXISTS (
            SELECT 1 FROM `auth_item` WHERE name='Administrador' and type=1
            )LIMIT 1;
            ");

       /* $this->insert('user', [
            'id' => '1',
            'username' => 'admin',
            'password_hash' => 'd033e22ae348aeb5660fc2140aec35850c4da997',
            'password_reset_token' => ' ',
            'email' => ' ',
            'status' => '1',
            'created_at' => '0',
            'updated_at' => '0',
            'auth_key' => ''
            ]);*/


        $this->execute("
            insert into auth_item (name,type)
            select * from (select '/*',2 ) as tmp
            where not EXISTS (
            SELECT 1 FROM `auth_item` WHERE name='/*' and type=2
            )LIMIT 1;

            "
            );

        $this->execute("
            insert into auth_item (name,type)
            select * from (select 'Administrador',1 ) as tmp
            where not EXISTS (
            SELECT 1 FROM `auth_item` WHERE name='Administrador' and type=1
            )LIMIT 1;

            "
            );

        $this->execute(
            "
            insert into auth_item_child (parent,child)
            select * from (select 'Administrador','/*' ) as tmp
            where not EXISTS (
            SELECT 1
            FROM auth_item_child aic join auth_item ai
            WHERE parent='Administrador'
            and child='/*'
            and aic.parent=ai.name
            and ai.type=1
            )
            and exists(
            select * from auth_item where name='/*'
            )
            LIMIT 1;
            ");

        $this->insert('auth_assignment', [
            'item_name' => 'Administrador',
            'user_id' => '1',
            'created_at' => '0',
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'Administrador',
            'user_id' => '2',
            'created_at' => '0',
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'Administrador',
            'user_id' => '3',
            'created_at' => '0',
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'Administrador',
            'user_id' => '4',
            'created_at' => '0',
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'Administrador',
            'user_id' => '5',
            'created_at' => '0',
        ]);
	
	    $this->insert('auth_assignment', [
		    'item_name' => 'Administrador',
		    'user_id' => '6',
		    'created_at' => '0',
	    ]);
	
	    $this->insert('auth_assignment', [
		    'item_name' => 'Administrador',
		    'user_id' => '7',
		    'created_at' => '0',
	    ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171221_115305_add_admin_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171221_115305_add_admin_users cannot be reverted.\n";

        return false;
    }
    */
}
