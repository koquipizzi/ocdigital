<?php

use yii\db\Migration;

/**
 * Class m180607_122622_rol_viajante
 */
class m180607_122622_rol_viajante extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {        
         $this->insert('auth_item', [
             'name' => 'Viajante',
             'type' => 1,
         ]);
         
         $this->insert('auth_item', [
             'name' => '/pedido/create',
             'type' => 2,
         ]);
    
        $this->insert('auth_item', [
            'name' => '/pedido/index',
            'type' => 2,
        ]);
        
        $this->insert('auth_item', [
            'name' => '/pedido/productos-por-cliente',
            'type' => 2,
        ]);
        
        $this->insert('auth_item', [
            'name' => '/site/logout',
            'type' => 2,
        ]);
    
        $this->insert('user', [
            'username' => 'Viajante',
            'password_hash' => '$2y$10$g5Qy2oXPIUBw1Wq5sT21reKS1EGZ6JOYriOlQEXW1qBTnpUVXs2fe',
            'status' => '1',
            'id' => 8,
        ]);
    
        $this->insert('auth_item_child', [
            'parent' =>  'Viajante',
            'child' => '/pedido/create',
        ]);
    
        $this->insert('auth_item_child', [
            'parent' =>  'Viajante',
            'child' => '/pedido/index',
        ]);
    
        $this->insert('auth_item_child', [
            'parent' =>  'Viajante',
            'child' => '/pedido/productos-por-cliente',
        ]);
        
        $this->insert('auth_item_child', [
            'parent' =>  'Viajante',
            'child' =>  '/site/logout',
        ]);
    
        $this->insert('auth_assignment', [
            'item_name' => 'Viajante',
            'user_id' => '8',
            'created_at' => '0',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('auth_assignment',[
            'item_name' => 'Viajante',
            'user_id' => '8',
        ]);
    
        $this->delete('auth_item_child',[
            'parent' =>  'Viajante',
            'child' => '/pedido/create',
        ]);
    
        $this->delete('auth_item_child', [
            'parent' =>  'Viajante',
            'child' => '/pedido/index',
        ]);
    
        $this->delete('auth_item_child', [
            'parent' =>  'Viajante',
            'child' => '/pedido/productos-por-cliente',
        ]);
    
        $this->delete('user', [
            'username' => 'Viajante',
            'password_hash' => '$2y$10$g5Qy2oXPIUBw1Wq5sT21reKS1EGZ6JOYriOlQEXW1qBTnpUVXs2fe',
            'status' => '1',
            'id' => 8,
        ]);
    
        $this->delete('auth_item', [
            'name' => '/pedido/create',
            'type' => 2,
        ]);
        
        $this->delete('auth_item', [
            'name' => '/pedido/index',
            'type' => 2,
        ]);
        
        $this->delete('auth_item', [
            'name' => '/pedido/productos-por-cliente',
            'type' => 2,
        ]);
    
        $this->delete('auth_item', [
            'name' => '/site/logout',
            'type' => 2,
        ]);
    
        $this->delete('auth_item', [
            'name' => 'Viajante',
            'type' => 1,
        ]);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180607_122622_rol_viajante cannot be reverted.\n";

        return false;
    }
    */
}
