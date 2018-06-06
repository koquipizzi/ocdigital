<?php

use yii\db\Migration;

/**
 * Class m171221_115057_new_customers
 */
class m171221_115057_new_customers extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

      $this->insert('cliente', [
          'id' => 1,
          'razon_social' => 'Alejandra Pizzi',
          'nombre' => 'Maria Alejandra',
          'apellido' => 'Pizzi',
          'usuario_web' => 'koqui',
          'password_web' => 'koqui',
          'web_customer_id' => 2,
          'email' => 'alejandra@qwavee.com',

      ]);

      $this->insert('cliente', [
          'id' => 2,
          'razon_social' => 'Agustin Diaz',
          'nombre' => 'Agustin',
          'apellido' => 'Diaz Gargiulo',
          'usuario_web' => 'agus',
          'password_web' => 'agus',
          'web_customer_id' => 25,
          'email' => 'Agussdiaz28@gmail.com',

      ]);

      $this->insert('cliente', [
          'id' => 3,
          'razon_social' => 'Diego Rodriguez',
          'nombre' => 'Diego',
          'apellido' => 'Rodriguez',
          'usuario_web' => 'Diego',
          'password_web' => 'diego',
          'web_customer_id' => 40,
          'email' => 'diego@qwavee.com',
      ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
      $this->delete('cliente', ['id' => 1]);
      $this->delete('cliente', ['id' => 2]);
      $this->delete('cliente', ['id' => 3]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171221_115057_new_customers cannot be reverted.\n";

        return false;
    }
    */
}
