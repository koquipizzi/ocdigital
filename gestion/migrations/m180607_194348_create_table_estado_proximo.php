<?php
    
    use yii\db\Migration;
    
    /**
     * Class m180607_194348_create_table_estado_proximo
     */
    class m180607_194348_create_table_estado_proximo extends Migration
    {
        /**
         * @inheritdoc
         */
        public function safeUp()
        {
            $this->createTable('estado_proximo', [
             'id' => $this->primaryKey()->notNull(),
             'estado_origen_id' => $this->integer(11)->notNull(),
             'estado_destino_id' => $this->integer(11)->notNull()
            ]);
            //-- ---------------------------
            // fk estado_origen_id
            $this->createIndex(
             'idx_estado_proximoo_estado_estado_origen_id',
             'estado_proximo',
             'estado_origen_id'
            );
            
            $this->addForeignKey(
             'fk_estado_proximo_estado_estado_origen_id',
             'estado_proximo',
             'estado_origen_id',
             'estado',
             'id'
            );
            //-- ---------------------------
            // fk estado_destino_id
            $this->createIndex(
             'idx_estado_proximo_estado_estado_destino_id',
             'estado_proximo',
             'estado_destino_id'
            );
            
            $this->addForeignKey(
             'fk_estado_proximo_estado_estado_destino_id',
             'estado_proximo',
             'estado_destino_id',
             'estado',
             'id'
            );
        }
        
        /**
         * @inheritdoc
         */
        public function safeDown()
        {
            
            //-----------------------------
            //delete fk estado_origen_id
            
            $this->dropForeignKey(
             'fk_estado_proximo_estado_estado_origen_id',
             'estado_proximo'
            );
            
            $this->dropIndex(
             'idx_estado_proximo_estado_estado_origen_id',
             'estado_proximo'
            );
            
            //-----------------------------
            //delete fk estado_destino_id
            
            $this->dropForeignKey(
             'fk_estado_proximo_estado_destino_id',
             'estado_proximo'
            );
            
            $this->dropIndex(
             'idx_estado_proximo_estado_estado_destino_id',
             'estado_proximo'
            );
            
            
            $this->dropTable("estado_proximo");
            
        }
        
    }