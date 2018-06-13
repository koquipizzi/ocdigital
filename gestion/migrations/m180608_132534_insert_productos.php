<?php

use yii\db\Migration;

/**
 * Class m180608_132534_insert_productos
 */
class m180608_132534_insert_productos extends Migration
{
 /**
     * @inheritdoc
     */
    public function safeUp()
    {
      $this->insert('producto', [
          'codigo' => 143975,
          'categoria_id' => 2,
          'nombre' => 'Cordón Galvanizado-3x2, 40-RS500M',
          'precio_unitario' => 73,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 1,
      ]);

      $this->insert('producto', [
          'codigo' => 147778,
          'categoria_id' => 2,
          'nombre' => 'Cordón P/Pret.Rel. Tens.-2x2, 25MM BOB.CHC',
          'precio_unitario' => 73,
          'web_id' => 1630,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 2,
      ]);
      

      $this->insert('producto', [
          'codigo' => 147780,
          'categoria_id' => 2,
          'nombre' => 'CORDÓN P/PRET.REL. TENS.-2x2, 25MM',
          'precio_unitario' => 73,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 3,
      ]);
      

      $this->insert('producto', [
          'codigo' => 147782,
          'categoria_id' => 2,
          'nombre' => 'CORDÓN P/PRET.REL. TENS.-3X3,00MM',
          'precio_unitario' => 73,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 4,
      ]);
      

      $this->insert('producto', [
          'codigo' => 186959,
          'categoria_id' => 2,
          'nombre' => 'CORDÓN P/PRET.REL. TENS.-2X2, 25MM RS 660KG',
          'precio_unitario' => 73,
      ]);
      $this->insert('producto_rol', [
          'rol_id' => 1,
          'producto_id' => 5,
      ]);
      
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('producto', ['id' > 0]);
    }
}
