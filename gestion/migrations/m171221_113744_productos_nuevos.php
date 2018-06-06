<?php

use yii\db\Migration;

/**
 * Class m171221_113744_productos_nuevos
 */
class m171221_113744_productos_nuevos extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('producto', [
          'id' => 1,
          'maxirest_id' => 1,
          'categoria_id' => 2,
          'nombre' => 'Muffin Arandanos',
          'precio_unitario' => 73,
          'web_id' => 1629,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 1,
      ]);

      $this->insert('producto', [
          'id' => 2,
          'maxirest_id' => 12,
          'categoria_id' => 2,
          'nombre' => 'Muffin Frambuesa',
          'precio_unitario' => 74,
          'web_id' => 1630,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 2,
      ]);
      

      $this->insert('producto', [
          'id' => 3,
          'maxirest_id' => 13,
          'categoria_id' => 2,
          'nombre' => 'Muffin Chocolate y Banana',
          'precio_unitario' => 72,
          'web_id' => 1631,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 3,
      ]);
      

      $this->insert('producto', [
          'id' => 4,
          'maxirest_id' => 14,
          'categoria_id' => 2,
          'nombre' => 'Muffin Vainilla',
          'precio_unitario' => 75,
          'web_id' => 1632,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 4,
      ]);
      

      $this->insert('producto', [
          'id' => 5,
          'maxirest_id' => 10,
          'categoria_id' => 1,
          'nombre' => 'Cheesecake clásico individual',
          'precio_unitario' => 65,
          'web_id' => 1633,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 5,
      ]);
      

      $this->insert('producto', [
          'id' => 6,
          'maxirest_id' => 50,
          'categoria_id' => 3,
          'nombre' => 'Medialuna cocida',
          'precio_unitario' => 8,
          'web_id' => 1634,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 6,
      ]);
      

      $this->insert('producto', [
          'id' => 7,
          'maxirest_id' => 70,
          'categoria_id' => 4,
          'nombre' => 'Baguettin Blanco',
          'precio_unitario' => 15,
          'web_id' => 1635,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 7,
      ]);
      

      $this->insert('producto', [
          'id' => 8,
          'maxirest_id' => 1100,
          'categoria_id' => 4,
          'nombre' => 'Pan de hamburguesa  blanco de 10 cm',
          'precio_unitario' => 25,
          'web_id' => 1636,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 8,
      ]);
      

      $this->insert('producto', [
          'id' => 9,
          'maxirest_id' => 1302,
          'categoria_id' => 4,
          'nombre' => 'Zepelin Campo',
          'precio_unitario' => 45,
          'web_id' => 1637,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 9,
      ]);
      

      $this->insert('producto', [
          'id' => 10,
          'maxirest_id' => 1401,
          'categoria_id' => 5,
          'nombre' => 'Tarta de Espinaca, cherry y queso',
          'precio_unitario' => 165,
          'web_id' => 1638,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 10,
      ]);
      

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('producto', ['id' => 1]);
        $this->delete('producto', ['id' => 2]);
        $this->delete('producto', ['id' => 3]);
        $this->delete('producto', ['id' => 4]);
        $this->delete('producto', ['id' => 5]);
        $this->delete('producto', ['id' => 6]);
        $this->delete('producto', ['id' => 7]);
        $this->delete('producto', ['id' => 8]);
        $this->delete('producto', ['id' => 9]);
        $this->delete('producto', ['id' => 10]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171221_113744_productos_nuevos cannot be reverted.\n";

        return false;
    }
    */
}
