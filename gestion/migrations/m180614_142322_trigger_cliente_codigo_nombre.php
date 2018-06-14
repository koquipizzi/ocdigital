<?php

use yii\db\Migration;

/**
 * Class m180614_142322_trigger_cliente_codigo_nombre
 */
class m180614_142322_trigger_cliente_codigo_nombre extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            
            CREATE TRIGGER tu_codigo_nombre_cliente
                BEFORE UPDATE ON cliente
                FOR EACH ROW
            BEGIN
                IF NEW.codigo IS NOT NULL THEN
                   SET NEW.codigo_nombre_cliente = CONCAT (NEW.codigo,'-',NEW.razon_social) ;
                ELSE
                   SET NEW.codigo_nombre_cliente =  NEW.razon_social;
                END IF;
            END
        ");
        
        $this->execute("
            CREATE  TRIGGER ti_codigo_nombre_cliente
                BEFORE INSERT ON cliente
                FOR EACH ROW
            BEGIN
                IF NEW.codigo IS NOT NULL THEN
                   SET NEW.codigo_nombre_cliente = CONCAT (NEW.codigo,'-',NEW.razon_social) ;
                ELSE
                   SET NEW.codigo_nombre_cliente =  NEW.razon_social;
                END IF;
            END
        ");
    
        $this->execute("
            update cliente set codigo_nombre_cliente = '' where id > 0;
        ");
        
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->execute("
            DROP TRIGGER tu_codigo_nombre_cliente;
            DROP trigger ti_codigo_nombre_cliente;
        ");
    }
    
}
