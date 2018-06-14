<?php

use yii\db\Migration;

/**
 * Class m180611_173619_view_pedido_ultimo_workflow
 */
class m180611_173619_view_pedido_ultimo_workflow extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->execute("
            CREATE VIEW view_pedido_ult_workflow AS
            SELECT
                workflow.pedido_id,
                MAX(workflow.id) AS id
            FROM
                workflow
            GROUP BY workflow.pedido_id;
        
        ");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->execute("drop view view_pedido_ult_workflow");
    }

   
}
