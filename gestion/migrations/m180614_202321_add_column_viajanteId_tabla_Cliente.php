<?php

use yii\db\Migration;

/**
 * Class m180614_202321_add_column_viajanteId_tabla_Cliente
 */
class m180614_202321_add_column_viajanteId_tabla_Cliente extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('cliente','viajante_id',$this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('cliente','viajante_id');
    }


}
