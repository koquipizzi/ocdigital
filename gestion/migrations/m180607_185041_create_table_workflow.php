<?php

use yii\db\Migration;

/**
 * Class m180607_185041_create_table_workflow
 */
class m180607_185041_create_table_workflow extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->createTable('workflow', [
         'id'               => $this->primaryKey()->notNull(),
         'fecha_inicio'     => $this->date()->notNull(),
         'fecha_fin'        => $this->date()->null(),
         'estado_id'        => $this->integer(11)->notNull(),
         'user_id'          => $this->integer(11)->notNull(),
         'pedido_id'        => $this->integer(11)->notNull(),
        ] );
        //-- ---------------------------
        // fk pedido
        $this->createIndex(
         'idx_workflow_pedido',
         'workflow',
         'pedido_id'
        );
        
        $this->addForeignKey(
         'fk_workflow_pedido',
         'workflow',
         'pedido_id',
         'pedido',
         'id'
        );
        //-- --------------------------
        //fk usuario
        $this->createIndex(
         'idx_workflow_user',
         'workflow',
         'user_id'
        );
        
        $this->addForeignKey(
         'fk_workflow_user',
         'workflow',
         'user_id',
         'user',
         'id'
        );
        
        //-- --------------------------
        //fk estado
        $this->createIndex(
         'idx_workflow_estado',
         'workflow',
         'estado_id'
        );
        
        $this->addForeignKey(
         'fk_workflow_estado',
         'workflow',
         'estado_id',
         'estado',
         'id'
        );
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        
        //-----------------------------
        //delete fk pedido
        $this->dropForeignKey(
         'fk_workflow_pedido',
         'workflow'
        );
        
        $this->dropIndex(
         'idx_workflow_pedido',
         'workflow'
        );
        
        //-----------------------------
        //delete fk usuario
        
        $this->dropForeignKey(
         'fk_workflow_user',
         'workflow'
        );
        
        // drops index for column `author_id`
        $this->dropIndex(
         'idx_workflow_user',
         'workflow'
        );
        
        //-----------------------------
        //delete fk estado
        
        $this->dropForeignKey(
         'fk_workflow_estado',
         'workflow'
        );
        
        // drops index for column `author_id`
        $this->dropIndex(
         'idx_workflow_estado',
         'workflow'
        );
        
        $this->dropTable("workflow");
        
        
    }
}
