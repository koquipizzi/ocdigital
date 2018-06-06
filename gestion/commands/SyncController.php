<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;


use app\models\Producto;
use Yii;
use yii\console\Controller;
use app\controllers\PedidoController;
use app\models\Mail;
use app\models\Pedido;
use app\models\Log;
use app\models\Cliente;
use app\models\PedidoDetalle;
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

    const ERROR_SYNC_PEDIDOS_WEB = 1; // ID de la accion con los mails
    const ERROR_SYNC_USUARIOS_MAXIREST = 2; // ID de la accion con los mails asociados correspondientes
    
    const PATH_MAXIREST_CLIENTES_DB_FILE = '/home/superq/Escritorio/DATOS/mxcli.dbf';
    const PATH_MAXIREST_PRODUCTOS_DB_FILE = '/home/superq/Escritorio/DATOS/mxart.dbf';
    const PATH_MAXIREST_PEDIDOS_DB_FILE = '/home/superq/Escritorio/DATOS/mxape.dbf';
    const PATH_MAXIREST_DETALLE_PEDIDOS_DB_FILE = '/home/superq/Escritorio/DATOS/mxadi.dbf';
    
    const MAX_CANT_INTENTOS = 4;
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSincronizar()
    {
        $html_mensaje = "<b> Existe un problema en el proceso de sincronización de pedidos WEB. Póngase en contacto con los administradores del sistema.</b>";
       if (!$this->process_running(self::ERROR_SYNC_PEDIDOS_WEB,$html_mensaje)){
           $pid = getmypid();
           $this->initLog($pid);
           $date = new \DateTime('-7 days');
           $pedidos = Yii::$app->woocomponent->getPedidos($date->format('Y-m-d H:i:s'));
           PedidoController::guardarPedido($pedidos);
            if(true){
                Yii::$app->db->close();
                Yii::$app->db->open();
            }
            $this->deleteLog($pid);
        }
    } //funcion que sincroniza los pedidos web

    private function deleteLog($pid)
    {
        Log::findOne(['pid' => $pid])->delete();
    }
    
    private function initLog($pid)
    {
        Yii::$app->db->createCommand()->insert('log', [
            'cont' => 0,
            'pid' => $pid,
        ])->execute();
    }
    
    private function sendMailErrorSync($error_id,$html_mensaje)
    {
      $mails = Mail::find()->where(['id' => $error_id])->one();
      $mails = $mails->mails;
      $mails = explode(";", $mails);
      $mail = Yii::$app->mailer->compose()->setFrom('pedidos@prosperovelazco.com')
      ->setTo($mails)
      ->setTextBody('SGC')
      ->setSubject('Alerta de proceso con problemas')
      ->setHtmlBody($html_mensaje);
      $envio = $mail->send();
    } //Envia emails a las personas correspondientes dependiendo del id del error del proceso
    
    public function actionLeerclientesvfp() //funcion que lee los archivos VFP y los guarda en nuestra base de datos
    {
        $html_mensaje = "<b> Existe un problema en el proceso de sincronización de clientes MAXIREST. Póngase en contacto con los administradores del sistema.</b>";
        if (!$this->process_running(self::ERROR_SYNC_USUARIOS_MAXIREST,$html_mensaje)){
            
            $pid = getmypid();
            $this->initLog($pid);
            
            $path = self::PATH_MAXIREST_CLIENTES_DB_FILE;
            $db = dbase_open($path, 0);
    
            $record_numbers = dbase_numrecords($db);
            for ($i = 1; $i <= $record_numbers; $i++) {
                $row = dbase_get_record_with_names($db, $i);
                $maxirest_id = (int) trim($row['CODIGO']);
                $model_cliente = null;
                if (!empty($maxirest_id)) {
                    if ($this->new_user_maxirest($maxirest_id)) {
                        $model_cliente = new Cliente();
                        $model_cliente->maxirest_id = $maxirest_id;
                    }else {
                        $model_cliente = Cliente::find()->where(['maxirest_id' => $maxirest_id])->one();
                    }
                    $nombre_usuario = trim($row['NOMBRE']);
                    if (!empty($nombre_usuario)) {
                        $model_cliente->nombre = utf8_encode($nombre_usuario);
                    }
                    $calle_usuario = trim($row['CALLE']);
                    if (!empty($calle_usuario)) {
                        $model_cliente->direccion = utf8_encode($calle_usuario);
                    }
                    $apellido_usuario = trim($row['APELLIDO']);
                    if (!empty($apellido_usuario)) {
                        $model_cliente->apellido = utf8_encode($apellido_usuario);
                    }else{
                        $model_cliente->apellido = 'SIN DEFINIR';
                    }
                    $email_usuario = trim($row['E_MAIL']);
                    if (!empty($razon_usuario)) {
                        $model_cliente->email = utf8_encode($email_usuario);
                    }else{
                        $model_cliente->email = 'SIN DEFINIR';
                    }
                    $telefono_usuario = trim($row['TELEFONO']);
                    if (!empty($telefono_usuario)) {
                        $model_cliente->telefono = utf8_encode($telefono_usuario);
                    }
                    $razon_usuario = trim($row['RAZON']);
                    if (!empty($razon_usuario)) {
                        $model_cliente->razon_social = utf8_encode($razon_usuario);
                    }
                    $model_cliente->save();
                }
            }
            dbase_close($db);
            $this->deleteLog($pid);
        }
        
    }
    
    private function new_user_maxirest($maxirest_id) //function privada que devuelve si dado un id de maxirest el usuario es nuevo o no
    {
        $response = false;
        $new_user = Cliente::find()->where(['maxirest_id' => $maxirest_id])->one();
        
        if (empty($new_user))
        {
            $response = true;
        }else{
            $response = false;
        }
        
        return $response;
        
    }
    
    public function actionShowfile()
    {
        $path = self::PATH_MAXIREST_PRODUCTOS_DB_FILE;
        /*$path = self::PATH_MAXIREST_DETALLE_PEDIDOS_DB_FILE;*/
        $db = dbase_open($path, 0);
        //var_dump(dbase_get_header_info($db));
       /* $row = dbase_get_record_with_names($db, 1);
         var_dump($row);
        die();*/
        $record_numbers = dbase_numrecords($db);
        for ($i = 1; $i <= $record_numbers; $i++) {
            $row = dbase_get_record_with_names($db, $i);
            print_r($row);
            /*var_dump(dbase_get_header_info($db));*/
        }
        dbase_close($db);
    } //funcion generica que muestra datos de los archivos
    
    private function process_running($error_id,$html_mensaje){
        $response = false;
        $db = Yii::$app->db;
        $currentJobs = $db->createCommand('SELECT COUNT(*) as cant FROM log')->queryOne();
        if (!empty($currentJobs['cant'])) {
            $intentos = $db->createCommand('SELECT sum(cont) as cant FROM log')->queryOne();
            if ($intentos['cant'] > self::MAX_CANT_INTENTOS) {
                $html_mensaje = "<b> Existe un problema en el proceso de sincronización de pedidos WEB. Póngase en contacto con los administradores del sistema.</b>";
                $this->sendMailErrorSync($error_id, $html_mensaje);
            }
            $db->createCommand('UPDATE log SET cont = cont + 1')->execute();
            $response = true;
        }
        return $response;
    }
}
