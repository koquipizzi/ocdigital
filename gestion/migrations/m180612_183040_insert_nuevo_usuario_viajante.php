<?php

use yii\db\Migration;

/**
 * Class m180612_183040_insert_nuevo_usuario_viajante
 */
class m180612_183040_insert_nuevo_usuario_viajante extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('user', [
         'username' => 'Viajante2',
         'password_hash' => '$2y$10$g5Qy2oXPIUBw1Wq5sT21reKS1EGZ6JOYriOlQEXW1qBTnpUVXs2fe',
         'status' => '1',
         'id' => 11,
        ]);
        $this->insert('auth_assignment', [
         'item_name' => 'Viajante',
         'user_id' => '11',
         'created_at' => '0',
        ]);
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete("auth_assignment",["item_name"=>"Viajante","user_id"=>"11"]);
        $this->delete("auth_assignment",["username"=>"Viajante2","id"=>"11"]);
    }

 
}
