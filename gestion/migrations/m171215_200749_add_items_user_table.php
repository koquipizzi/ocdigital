<?php

use yii\db\Migration;

/**
 * Class m171215_200749_add_items_user_table
 */
class m171215_200749_add_items_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'prospero',
            'password_hash' => '$2y$10$Oq68XFPPVV4ffJYT1ZTh8u2X3YaenzvCW9virLR1jciqjUkOn/ZFy',
            'status' => '1'
        ]);
        
        $this->insert('user', [
            'username' => 'flor',
            'password_hash' => '$2y$10$LZFC8Anja9fbMnoP5ldmIOJSdlzz/DLn3SS3P7y3XnjOfx3OMb8ju',
            'status' => '1'
        ]);
        
        $this->insert('user', [
            'username' => 'maria',
            'password_hash' => '$2y$10$De6BsduJFOsW0jx4SZLsY.2kn5NgaS6esiOWm.PEr8c7gOk6QXsu.',
            'status' => '1'
        ]);
        
        $this->insert('user', [
            'username' => 'kinia',
            'password_hash' => '$2y$10$VNOC/xOkt/QVBo2QPWLS5eyX7/W5iNAzvMedL1mMaoc/2TFo.DJxu',
            'status' => '1'
        ]);
        
        $this->insert('user', [
            'username' => 'qwavee',
            'password_hash' => '$2y$10$g5Qy2oXPIUBw1Wq5sT21reKS1EGZ6JOYriOlQEXW1qBTnpUVXs2fe',
            'status' => '1'
        ]);
	
	    $this->insert('user', [
		    'username' => 'paula',
		    'password_hash' => '$2y$10$bZF9kMmdu7xZ7tJcNRpaNO/cKBzVIAwH.35TjKNoeVjQfnisd/yIu',
		    'status' => '1'
	    ]);

        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => '$2y$10$g5Qy2oXPIUBw1Wq5sT21reKS1EGZ6JOYriOlQEXW1qBTnpUVXs2fe',
            'status' => '1'
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('user', ['username' => 'koqui']);
        $this->delete('user', ['username' => 'diego']);
        $this->delete('user', ['username' => 'fran']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171215_200749_add_items_user_table cannot be reverted.\n";

        return false;
    }
    */
}
