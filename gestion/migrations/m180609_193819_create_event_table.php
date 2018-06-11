<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `event`.
 */
class m180609_193819_create_event_table extends Migration
{
    const TABLE = '{{%event}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('event', [
            'id'            => Schema::TYPE_PK. ' NOT NULL AUTO_INCREMENT',
            'title'         => Schema::TYPE_STRING,
            'allDay'        => Schema::TYPE_STRING,
            'start'         => Schema::TYPE_DATETIME . ' NOT NULL',
            'end'           => Schema::TYPE_DATETIME . ' NOT NULL',
            'entrega'       => Schema::TYPE_DATETIME . ' NOT NULL',
            'url'           => Schema::TYPE_STRING,
            'className'     => Schema::TYPE_STRING,
            'editable'      => Schema::TYPE_STRING,
            'startEditable'      => Schema::TYPE_STRING,
            'durationEditable'      => Schema::TYPE_STRING,
            'source'      => Schema::TYPE_STRING,
            'color'      => Schema::TYPE_STRING,
            'backgroundColor'      => Schema::TYPE_STRING,
            'borderColor'      => Schema::TYPE_STRING,
            'textColor'      => Schema::TYPE_STRING
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('event');
    }
}
