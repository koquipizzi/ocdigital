<?php

use yii\db\Migration;

/**
 * Class m180621_114355_estado_add_estado_inicial
 */
class m180621_114355_estado_add_estado_inicial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("estado","estado_inicial", $this->integer(1)->defaultValue(0));
        $this->update("estado",["estado_inicial"=>1],["id"=>1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->update("estado",["estado_inicial"=>0],["id"=>1]);
       $this->dropColumn("estado","estado_inicial");
    }
    
}
