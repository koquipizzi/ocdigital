<?php

use yii\db\Migration;

/**
 * Class m180611_152936_workflow_alter_table_colum_fechas
 */
class m180611_152936_workflow_alter_table_colum_fechas extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn(
         "workflow",
        "fecha_inicio",
                $this->datetime()->notNull());
        
        $this->alterColumn(
          "workflow",
         "fecha_fin",
                $this->datetime()->null());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn("workflow","fecha_inicio",$this->date()->notNull());
        $this->alterColumn("workflow","fecha_fin",$this->date()->null());
    
    }

}
