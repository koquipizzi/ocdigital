<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;


use Yii;
use yii\console\Controller;
use app\controllers\PedidoController;
use app\models\Mail;
use yii\helpers\FileHelper;
use app\models\Log;
use yii\helpers\Console;
use app\componets;
use Automattic\WooCommerce\Client;
use app\components\WooComponent;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SyncController extends Controller
{

    const ERROR_SYNC = 1; // ID de la accion con los mails
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSincronizar()
    {
        $db = Yii::$app->db;
        $currentJobs = $db->createCommand('SELECT COUNT(*) as cant FROM log')->queryOne();
        if (!empty($currentJobs['cant'])) {
            $intentos = $db->createCommand('SELECT sum(cont) as cant FROM log')->queryOne();
            if ($intentos['cant'] > 4) {
              $this->sendMailErrorSync();
            }
            $db->createCommand('UPDATE log SET cont = cont + 1')->execute();
        }else{
              $pid = getmypid();
              $db->createCommand()->insert('log', [
                'cont' => 0,
                'pid' => $pid,
                ])->execute();
               $date = new \DateTime('-7 days');
               $pedidos = Yii::$app->woocomponent->getPedidos($date->format('Y-m-d H:i:s'));
               PedidoController::guardarPedido($pedidos);
                if(true){
                    Yii::$app->db->close();
                    Yii::$app->db->open();
                }
                $this->deleteLog($pid);
        }
    }

    private function deleteLog($pid)
    {
      Log::findOne(['pid' => $pid])->delete();
    }

    private function sendMailErrorSync()
    {
      $mails = Mail::find()->where(['id' => self::ERROR_SYNC])->one();
      $mails = $mails->mails;
      $mails = explode(";", $mails);
      $mail = Yii::$app->mailer->compose()->setFrom('adiaz@qwavee.com')
      ->setTo($mails)
      ->setTextBody('SGC')
      ->setSubject('Alerta de proceso con problemas')
      ->setHtmlBody("<b> Existe un problema en el proceso de sincronización de pedidos. Póngase en contacto con los administradores del sistema.</b>");
      $envio = $mail->send();
    }



}
