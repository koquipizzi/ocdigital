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
                IF NEW.codigo THEN
                   SET NEW.codigo_nombre_producto = CONCAT (NEW.codigo,'-',NEW.nombre) ;
                ELSE
                   SET NEW.codigo_nombre_producto =  NEW.nombre;
                END IF;
            END
        ");
        $this->execute("
            CREATE  TRIGGER ti_codigo_nombre_producto
                BEFORE INSERT ON producto
                FOR EACH ROW
            BEGIN
                IF NEW.codigo THEN
                   SET NEW.codigo_nombre_producto = CONCAT (NEW.codigo,'-',NEW.nombre) ;
                ELSE
                   SET NEW.codigo_nombre_producto =  NEW.nombre;
                END IF;
            END
        ");
        
        //para que la columna se setee con solo el nombre
        $this->execute("
            update producto set codigo_nombre_producto=' ' where id>0;
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
