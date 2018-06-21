<?php

use yii\db\Migration;

/**
 * Class m180621_140628_mail_alerta
 */
class m180621_140628_mail_alerta extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('mail',[
            'id' => 1,
            'accion' => 'ERROR_SYNC',
            'mails' => 'adiaz@qwavee.com'
        ]);
        $this->insert('mail',[
            'id' => 2,
            'accion' => 'PEDIDOS_OLVIDADOS_ID',
            'mails' => 'adiaz@qwavee.com'
        ]);
        $this->insert('mail',[
            'id' => 3,
            'accion' => 'ERROR_SISTEMA_ID',
            'mails' => 'adiaz@qwavee.com'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->delete('mail',['id' => 1]);
       $this->delete('mail',['id' => 2]);
       $this->delete('mail',['id' => 3]);
    }
}
