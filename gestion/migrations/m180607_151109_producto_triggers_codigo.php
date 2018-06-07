<?php

use yii\db\Migration;

/**
 * Class m180607_151109_producto_triggers_codigo
 */
class m180607_151109_producto_triggers_codigo extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->execute("
            
            CREATE TRIGGER tu_codigo_nombre_producto
                BEFORE UPDATE ON producto
                FOR EACH ROW
            BEGIN
                SET NEW.codigo_nombre_producto = CONCAT (NEW.codigo,'-',NEW.nombre) ;
            END
        ");
        $this->execute("
            CREATE  TRIGGER ti_codigo_nombre_producto
                BEFORE INSERT ON producto
                FOR EACH ROW
            BEGIN
                  SET NEW.codigo_nombre_producto = CONCAT (NEW.codigo,'-', NEW.nombre);
            END
        ");
    
     
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
         
        $this->execute("
            DROP TRIGGER tu_codigo_nombre_producto;
            DROP trigger ti_codigo_nombre_producto;
        ");
    }

    
}
