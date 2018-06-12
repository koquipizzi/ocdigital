<?php

namespace app\controllers;


use app\commands\SyncController;
use app\models\EstadoProximo;
use Yii;
use app\models\Pedido;
use app\models\PedidoSearch;
use app\models\PedidoDetalleSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Automattic\WooCommerce\Client;
use app\componets;
use app\models\Cliente;
use app\models\ProductoRol;
use app\models\ClienteRol;
use app\models\PedidoDetalle;
use app\models\Producto;
use yii\base\Model;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use app\models\ComandaDetalle;
use app\models\ProductoSearch;
use app\models\ComandaSearch;
use app\models\Comanda;
use app\models\Event;
use app\models\Workflow;
use app\models\Estado;

use kartik\mpdf\Pdf;

use bedezign\yii2\audit\models\AuditEntry;
use bedezign\yii2\audit\models\AuditEntrySearch;
use bedezign\yii2\audit\models\AuditTrail;
use bedezign\yii2\audit\models\AuditTrailSearch;

use yii\filters\AccessControl;
use common\models\LoginForm;
use \DateTime;
use yii\db\Query;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    /**
     * @inheritdoc
     */
    
    const PATH_MAXIREST_PEDIDOS_DB_FILE = '/home/superq/Escritorio/DATOS/mxape.dbf';
    const PATH_MAXIREST_DETALLE_PEDIDOS_DB_FILE = '/home/superq/Escritorio/DATOS/mxadi.dbf';

    public  $orden_entrega = array();

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProviderSinComandas = $searchModel->searchPedidosEnEspera(Yii::$app->request->queryParams);

        $orden_entrega = $this->orden_entrega;
        foreach ($dataProviderSinComandas->getModels() as $value)
            {
              $this->orden_entrega[] = $value['orden_reparto'];
            }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProviderSinComandas,
            'orden_reparto'=> $orden_entrega,
        ]);
    }
    
	public function actionHindex($info='')
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('hindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'info' => $info
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new PedidoDetalleSearch();
        $dataProvider = $searchModel->searchDetalle($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);
    }
	
	/**
	 * @return array
	 */
	public function actionEditCliente()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $contacto = Yii::$app->request->post('contacto');
        $pedido = Pedido::find()->where(['id' => $id])->one();

        try {
            if (empty($contacto)) {
                throw new \Exception('Campo vacío.');
            }
            $id = Yii::$app->request->post('id');
            $contacto = Yii::$app->request->post('contacto');
            $pedido = Pedido::find()->where(['id' => $id])->one();
            $cliente = $pedido->cliente;
            if (!empty($cliente)) {
                $cliente->contacto = $contacto;
                if ($cliente->save()) {
                    //Mensaje tiene que se vacío para que se cierre el popover del editable
                    $rta =  array("rta" => 'ok', "message" =>'') ;
                }
                else {
                    throw new \Exception('Error al guardar contacto. Póngase en contacto con el administrador');
                }
            }
        } catch (\Exception $e) {
            $e = $e->getMessage();
            $error = true;
            $rta = array('error' => $error, 'message' => $e);
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $rta;

    }
	
	/**
	 * @return array
	 */
	public function actionEditTelefono()
    {
        $post = Yii::$app->request->post();
        $telefono = $post['telefono'];
        $id = $post['id'];
        $rta = array();
        $pedido = Pedido::find()->where(['id' => $id])->one();

        try {
            if (empty($telefono)) {
                throw new \Exception('Campo vacío.');
            }
            $pedido = Pedido::find()->where(['id' => $id])->one();
            $cliente = $pedido->cliente;
            if (!empty($cliente)) {
                $cliente->telefono = $telefono;
                if ($cliente->save()) {
                    //Mensaje tiene que se vacío para que se cierre el popover del editable
                    $rta =  array("rta" => 'ok', "message" =>'') ;
                }
                else {
                    throw new \Exception("Error al guardar el teléfono. Contacte al administrador");
                }
            }
        } catch (\Exception $e) {
            $e = $e->getMessage();
            $error = true;
            $rta = array('error' => $error, 'message' => $e);
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $rta;

    }
	
	/**
	 * @return array
	 */
	public function actionEditClienteHoraEntrega()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $hora  = Yii::$app->request->post('hora_reparto');
        $id = Yii::$app->request->post('id');
    //    $pedido = Pedido::find()->where(['id' => $id])->one();

        try {
            if (empty($hora)) {
                throw new \Exception('Campo vacío.');
            }
            $id = Yii::$app->request->post('id');
        //    $contacto = Yii::$app->request->post('contacto');
            $pedido = Pedido::find()->where(['id' => $id])->one();
            $cliente = $pedido->cliente;
            if (!empty($cliente)) {
                $cliente->hora_reparto = $hora;
                if ($cliente->save()) {
                    //Mensaje tiene que se vacío para que se cierre el popover del editable
                    $rta =  array("rta" => 'ok', "message" =>'') ;
                }
                else {var_dump($cliente->getErrors()); die;
                    //throw new \Exception($cliente->getErrors());
                }
            }
        } catch (\Exception $e) {
            $e = $e->getMessage();
            $error = true;
            $rta = array('error' => $error, 'message' => $e);
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $rta;

    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelPedido = new Pedido();
        $modelEvent = new Event();
        $modelsPedidoDetalle = [new PedidoDetalle];
        $total = 0; //Cálculo de total de pedido
        $error = null;

        if ($modelPedido->load(Yii::$app->request->post())) {
            $modelPedido->gestor_id = Yii::$app->user->id;
            $modelPedido->save();
            $modelWorkflow = new Workflow();
            $modelEstado   = new Estado();
            $rowEstado= $modelEstado->find()->where(["id"=>1])->one();
            if (empty($rowEstado)) {
                throw new \Exception("model Estado es vacío.");
           }
            
            
            $modelsPedidoDetalle = PedidoDetalle::createMultiple(PedidoDetalle::classname(), $modelsPedidoDetalle );
            Model::loadMultiple($modelsPedidoDetalle, Yii::$app->request->post());

            // validate all models
            $valid = $modelPedido->validate();
        //    $valid = Model::validateMultiple($modelsPedidoDetalle) && $valid;

            if ($valid && !empty($modelsPedidoDetalle)) {
                $transaction = \Yii::$app->db->beginTransaction();
 
                $modelWorkflow->estado_id    = $rowEstado->id;
                $modelWorkflow->user_id      = Yii::$app->user->identity->getId();
                $modelWorkflow->pedido_id    = $modelPedido->id;
                $modelWorkflow->fecha_inicio = date('Y-m-d H:i:s');
                $modelWorkflow->save();
                if (empty($modelWorkflow)) {
                    throw new \Exception("model Workflow fallo al salvar.");
                }
                try {
                    if ($flag = $modelPedido->save(false)) {
                        foreach ($modelsPedidoDetalle as $pedidoDetalle) {
                            $pedidoDetalle->pedido_id = $modelPedido->id;
                            $producto = Producto::findOne($pedidoDetalle->producto_id);
                            $pedidoDetalle->precio_linea = (float)((double)$producto->precio_unitario * (int)$pedidoDetalle->cantidad) ;
                            $total = $pedidoDetalle->precio_linea + $total;

                            if (! ($flag = $pedidoDetalle->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $modelPedido->precio_total = $total;
                        $modelPedido->estado = Pedido::ESTADO_MANUAL;
                        $modelPedido->estado_id=1;
                        $modelPedido->save();
                    }

                    if ($flag) {
                        $transaction->commit();
                        $pedido = Pedido::findOne($modelPedido->id);
                        $modelEvent->start = $pedido->fecha_hora;
                        $modelEvent->end = $pedido->fecha_hora;
                        $modelEvent->entrega = $pedido->fecha_entrega;
                        $modelEvent->title = $pedido->cliente->nombre;
                        
                        if (!$modelEvent->save()) {
                            var_dump( $pedido->fecha_hora);
                            var_dump( $modelEvent->getErrors());
                            die();
                        }
                        return $this->redirect(['view', 'id' => $modelPedido->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            $error = 'No se pudo crear el pedido correctamente. El pedido debe contener un producto al menos';
        }

        return $this->render('create', [
            'model' => $modelPedido,
            'modelsPedidoDetalle' => (empty($modelsPedidoDetalle)) ? [new PedidoDetalle] : $modelsPedidoDetalle,
            'error' => $error
        ]);

    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $proceso=null)
    {

        $modelPedido = $this->findModel($id);
        $modelsPedidoDetalle = $modelPedido->pedidoDetalles;
        $total = 0; //Cálculo de total de pedido

        if ($modelPedido->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsPedidoDetalle, 'id', 'id');
            $modelsPedidoDetalle = PedidoDetalle::createMultiple(PedidoDetalle::classname(), $modelsPedidoDetalle);
            Model::loadMultiple($modelsPedidoDetalle, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPedidoDetalle, 'id', 'id')));

            // validate all models
            $valid = $modelPedido->validate();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                if(!empty($modelPedido->estado_id)) {
                    $this->updateEstado($modelPedido->estado_id,$modelPedido->id);
                }
                try {
                    if ($flag = $modelPedido->save()) {
                        if (!empty($deletedIDs)) {
                            PedidoDetalle::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPedidoDetalle as $modelPedidoDetalle) {
                            $modelPedidoDetalle->pedido_id = $modelPedido->id;
                            $producto = Producto::findOne($modelPedidoDetalle->producto_id);
                            
                             //Actualmente no calculamos el total del pedido
                            $modelPedidoDetalle->precio_linea = (float)((double)$producto->precio_unitario * (int)$modelPedidoDetalle->cantidad) ;
                            $total = $modelPedidoDetalle->precio_linea + $total;
                            
                            if (! ($flag = $modelPedidoDetalle->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $modelPedido->precio_total = $total;

                        $modelPedido->save();
                    }
                    return $this->redirect(['view', 'id' => $modelPedido->id]);
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        if ($proceso == 'aceptar') {
            $query = new Query;
            $query->select('estado.id,estado.descripcion')
             ->from('estado')
             ->join(
              'join',
              'estado_proximo',
              'estado.id =estado_proximo.estado_destino_id'
             )
             ->where(["estado_proximo.estado_origen_id" =>$modelPedido->estado_id]);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $arrayDataEstadoskv = array();
            if (!empty($data) && is_array($data) && is_array($data[0])) {
              //  var_dump($data[0]);
                foreach ($data as $k => $v) {
                    $arrayDataEstadoskv[$v['id']] = $v['descripcion'];
                }
            }
            return $this->render('update', [
             'model' => $modelPedido,
             'modelsPedidoDetalle' => (empty($modelsPedidoDetalle)) ? [new PedidoDetalle] : $modelsPedidoDetalle,
             'vista' => 'form_aceptar',
             'arrayDataEstadoskv' => $arrayDataEstadoskv
            ]);
        }
        else 
            return $this->render('update', [
                'model' => $modelPedido,
                'modelsPedidoDetalle' => (empty($modelsPedidoDetalle)) ? [new PedidoDetalle] : $modelsPedidoDetalle,
                'vista' => ''
                ]);



        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    
    
    private function updateEstado($stado_destino_id,$pedido_id){
     
            $idLastWorkflow              = Workflow::lastStatePedido($pedido_id);
            $modelLastWorkflow           = Workflow::find()->where(["id"=>$idLastWorkflow])->one();
            $modelLastWorkflow->fecha_fin= date('Y-m-d H:i:s');
       
            if(!$modelLastWorkflow->update() ){
                throw new \Exception("fallo al actualizar el modelo workflol. id={$modelLastWorkflow->id}.");
            }
 
            $modelWorkflow               = new Workflow();
            $modelWorkflow->estado_id    = $stado_destino_id;
            $modelWorkflow->user_id      = Yii::$app->user->identity->getId();
            $modelWorkflow->pedido_id    = $pedido_id;
            $modelWorkflow->fecha_inicio = date('Y-m-d H:i:s');
            if(!$modelWorkflow->save() ){
                throw new \Exception("fallo al actualizar el modelo workflow.");
            }
    }
    
    
    
    
    
    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      try {

        $model = $this->findModel($id);
        $data = ['status' => Pedido::ESTADO_CANCELADO];
        if ($model->estado != Pedido::ESTADO_MANUAL) {
            $pedidos = Yii::$app->woocomponent->updatePedido($model->web_id,$data);
        }
        $model->estado = Pedido::ESTADO_CANCELADO;
        $model->save();
        return $this->redirect(['index']);

      } catch (HttpClientException $e) {

      }
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	/**
	 * @return \yii\web\Response
	 * @throws \Exception
	 */
	public function actionSync()
    {
    $date = new \DateTime('-7 days');
    $pedidos = \Yii::$app->woocomponent->getPedidos($date->format('Y-m-d H:i:s'));
    $this->guardarPedido($pedidos);

    return $this->redirect(['index']);
    }
	
	/**
	 * @param $pedidos
	 * @throws \Exception
	 */
	public static function guardarPedido($pedidos)
    {
        foreach ($pedidos as $pedido) {
            //$transaction = \Yii::$app->db->beginTransaction();
            try{
                $model = new Pedido();
                $modelCliente = new Cliente();
                $modelProducto = new Producto();

                //Obtengo el id del usuario y el pedido id, par saber si es un pedido nuevo o no
                $web_customer_id = $pedido['customer_id'];
                $pedido_web_id = $pedido['id'] ;

                $cliente = $modelCliente->find()->where(['web_customer_id'=>$web_customer_id])->one();
                $pedidoPrevio = $model->find()->where(['web_id'=>$pedido_web_id])->one(); //If empty => new pedido
	            
                if (empty($pedidoPrevio) && !empty($cliente)) {
                    $f = new \DateTime($pedido['date_created']);
                    $model->fecha_hora = $f->format('Y-m-d H:i');
                    $model->web_id = (int) $pedido_web_id;
                    $model->precio_total = (double) $pedido['total'] ;
                    $model->estado = $pedido['status'];
                    $model->cliente_id = (int) $cliente->id;
                    $model->ship_company = $pedido['shipping']['company'];
                    $model->ship_address_1 = $pedido['shipping']['address_1'];
                    $model->ship_address_2 = $pedido['shipping']['address_2'];
                    $model->ship_city = $pedido['shipping']['city'] ;
                    $model->ship_state = $pedido['shipping']['state'];
                    $model->ship_postcode = $pedido['shipping']['postcode'];
                    $model->ship_country = $pedido['shipping']['country'] ;
                    if (array_key_exists("fecha_produccion",$pedido)){
                        $model->fecha_entrega = $pedido['fecha_produccion'];
                    }


                    if (!$model->save()) {
                        throw new \Exception("No se pudo guardar un pedido");
                    }

                    $pedido_id = $model->id;
                    $productos = $pedido['line_items'];

                    foreach ($productos as $producto) {
                        $modelDetalle = new PedidoDetalle();
                        $productoB = $modelProducto->find()->where(['web_id' => $producto['product_id']])->one();
                        if (!empty($productoB))
                        {
                            $modelDetalle->producto_id = $productoB->id;
                            $modelDetalle->pedido_id = $pedido_id ;
                            $modelDetalle->cantidad = $producto['quantity'];
                            $modelDetalle->precio_linea = $producto['total'];
                            $flag2 = $modelDetalle->save();
                            if (!$flag2) {
                                throw new Exception("No se pudo guardar un producto");
                            }
                        }
                    }

                    //$transaction->commit();

                }
            }catch (Exception $e) {
               //$transaction->rollBack();
            }
        }
    }

    private function createPedidoJSON($modelPedido)
    {
      $cliente = Cliente::findOne($modelPedido->cliente_id);
      $pedidoDetalles = PedidoDetalle::find()->where(['pedido_id' => $modelPedido->id])->all();
      $line_items = [];
      foreach ($pedidoDetalles as $pedidoDetalle) {
        $producto = Producto::findOne($pedidoDetalle['producto_id']);
        $line_items[] = [
            'product_id' => $producto['web_id'],
            'quantity' => $pedidoDetalle['cantidad']
        ];
      }
      $data = [
        'set_paid' => true,
        'customer_id' => $cliente['web_customer_id'],
        'billing' => [
          'first_name' => $cliente['nombre'],
          'last_name' => $cliente['apellido'],
          'address_1' => $modelPedido['ship_address_1'],
          'address_2' => $modelPedido['ship_address_2'],
          'city' => $modelPedido['ship_city'],
          'state' => 'B',
          'postcode' => $modelPedido['ship_postcode'],
          'country' => 'AR',
        ],
        'shipping' => [
          'first_name' => $cliente['nombre'],
          'last_name' => $cliente['apellido'],
          'address_1' => $modelPedido['ship_address_1'],
          'address_2' => $modelPedido['ship_address_2'],
          'city' => $modelPedido['ship_city'],
          'state' => 'B',
          'postcode' => $modelPedido['ship_postcode'],
          'country' => 'AR',
        ],
        'line_items' => $line_items,
      ];
      return $data;
    }
    
    /**
     * @param      $clienteId
     * @param null $q
     */
    public function actionProductosPorCliente($clienteId, $q=null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        $rolId = [];
        $rolesId = ClienteRol::find()->where(['cliente_id' => $clienteId])->all();
        foreach ($rolesId as $rol ) {
            $rolId[] =  $rol->rol_id;
        }
        if (!empty($rolId)){
            $productosRol = ProductoRol::find()->where(['in','rol_id', $rolesId])->all();
            $pr = [];
            foreach ($productosRol as $productoRol) {
                if (!in_array($productoRol->producto_id, $pr) ) {
                    $pr[] =  $productoRol->producto_id;
                }
            }
            if (!is_null($q)) {
                $productos = Producto::find()->Where(['in','id', $pr])
                 ->andFilterWhere(['like', 'codigo_nombre_producto', $q])->all();
            }
            else {
                $productos = Producto::find()->Where(['in','id', $pr])->all();
            }
            foreach ($productos as $producto){
                $out[] = ['id' => $producto->id, 'text' => $producto->codigo_nombre_producto];
            }
        }
        echo  json_encode(['results'=>$out]);
        die();
    }

	/**
	 * @param $id
	 * @throws NotFoundHttpException
	 */
	public function actionQuitarComanda($id)
    {
        $model = $this->findModel($id);
        $productosPedido = PedidoDetalle::find()->where(['pedido_id' => $id])->all();
        $comanda_id = $model->comanda_id;
        try {
            foreach ($productosPedido as $productoPedido) {
                $detalle = ComandaDetalle::find()->where(['producto_id' => $productoPedido->producto_id,'cantidad_produccion' => $productoPedido->cantidad, 'comanda_id' => $comanda_id])->one();
                if (!empty($detalle)){
                    if (!$detalle->delete()) {
                        throw new Exception("No se pudo quitar el pedido de la comanda");
                    }
                }

                if (!$productoPedido->save()){
                    throw new Exception("No se pudo guardar el cambio en la comanda");
                }
            }
          $model->comanda_id = null;
          if (!empty($model->web_id)) {
              $data = ['status' => Pedido::ESTADO_PROCESANDO];
              $model->estado = Pedido::ESTADO_PROCESANDO;
              $pedidos = Yii::$app->woocomponent->updatePedido($model->web_id,$data);
          }else {
              $model->estado = Pedido::ESTADO_MANUAL;
          }
          if (!$model->save()){
            throw new Exception("No se pudo quitar el pedido de la comanda");
          }
          $info = ['error' => false, 'mensaje' => 'El pedido se quitó de la comanda exitosamente'];
        } catch (Exception $e) {
          $info = ['error' => true, 'mensaje' => 'El pedido no se pudo quitar exitosamente'];
        }

        echo json_encode($info);
    }
	
	/**
	 * @param $mensaje
	 * @param $id
	 * @return string
	 */
	private function renderIndexComanda($mensaje, $id)
    {
      $searchModel = new ComandaSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('../comanda/index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'info' => $mensaje
      ]);
    }
	
    
	public function actionSubir()
    {
        $post = Yii::$app->request->get();
        $orden= $post['orden'];

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // Ver la orden de entrega anterior
        $searchModel = new PedidoSearch();
        $dataProviderSinComandas = $searchModel->searchPedidosComanda(Yii::$app->request->queryParams);

        $orden_entrega = $this->orden_entrega;
        foreach ($dataProviderSinComandas->getModels() as $value)
            {
              $this->orden_entrega[] = $value['orden_reparto'];
            }

        $orden_entrega = $this->orden_entrega;
        if ($this->orden_entrega[0] == $orden)
            die;
        else {
            $clave = array_search($orden, $orden_entrega);
            $claveanterior = $clave - 1;
            $pedido = Pedido::Find()->where(['orden_reparto' => $orden])->one();
            $pedidoAnterior = Pedido::Find()->where(['orden_reparto' => $orden_entrega[$claveanterior]])->one();

            $aux = $orden_entrega[$clave];
            $pedido->orden_reparto = $pedidoAnterior->orden_reparto;
            $pedido->save();

            $pedidoAnterior->orden_reparto = $aux;
            $pedidoAnterior->save();

        }
        echo  json_encode(['results'=>$orden_entrega]);
    }

    public function actionBajar()
    {
        $post = Yii::$app->request->get();
        $orden= $post['orden'];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Ver la orden de entrega anterior
        $searchModel = new PedidoSearch();
        $dataPedidos = $searchModel->searchPedidosComanda(Yii::$app->request->queryParams);
        $orden_entrega = $this->orden_entrega;
        foreach ($dataPedidos->getModels() as $value)
            {
              $this->orden_entrega[] = $value['orden_reparto'];
            }

        $orden_entrega = $this->orden_entrega;
        $ultimo = sizeof($this->orden_entrega) - 1;

        if ($this->orden_entrega[$ultimo] == $orden)
            die;
        else {
            $clave = array_search($orden, $orden_entrega);
            $claveposterior = $clave + 1;
            $pedido = Pedido::Find()->where(['orden_reparto' => $orden])->one();
            $pedidoAnterior = Pedido::Find()->where(['orden_reparto' => $orden_entrega[$claveposterior]])->one();

            $aux = $orden_entrega[$clave];
            $pedido->orden_reparto = $pedidoAnterior->orden_reparto;
            $pedido->save();

            $pedidoAnterior->orden_reparto = $aux;
            $pedidoAnterior->save();
        }
        echo  json_encode(['results'=>$orden_entrega]);
    }
    
    public function actionSyncmaxirest($id)
    {
        try{
            $pedido_id = $id;
            $path = self::PATH_MAXIREST_PEDIDOS_DB_FILE;
            $db = dbase_open($path, 2);
            $pedido = Pedido::find()->where(['id' => $pedido_id])->one();
            if (!$pedido->sync) {
                $cliente = Cliente::find()->where(['id' => $pedido->cliente_id])->one();
                $cliente_nombre = $cliente->nombre;
                $total = (int)((float)$pedido->precio_total + (float)$pedido->flete_valor);
                $fecha = new \DateTime($pedido->fecha_hora);
                $fecha_entrega = new \DateTime($pedido->fecha_entrega);
                $datos_pedido = [
                    "c",     //COD_CTV
                    FALSE,   //COMANDAS
                    $cliente_nombre, //NOMBRE
                    "2",     //MESA
                    "3",     //COD_CALL
                    "2",     //IDPEDYA
                    FALSE,   //WEB
                    1,       //CUBIERTOS
                    208,    //MOZO
                    $fecha->format('d/m/y'),  //FECHA_APE
                    $fecha->format('h:m'),     //HORA
                    (float)$total,  //SUBTOTAL
                    (float)$total,  //TOTAL
                    0,   //COD_DTO
                    "",  //NOMBRE_DTO
                    "",  //TIPO_DTO
                    (float)0, //VALOR_DTO
                    0, // DTO_CLI
                    "13:45", // HORA_CERR
                    "B",   // COD_CPB
                    "Ticket", //NOMBRE_CPB
                    0,  //FISCAL
                    1,  //PREFIJO
                    7,  // NUMERO
                    $fecha_entrega->format('d/m/y'), //FECHA_FIS
                    $fecha_entrega->format('h:m'), //HORA_FIS
                    0,  //TRANSP
                    3,  //COD_CLI
                    $cliente_nombre, //NOM_CLI
                    "", //APE_CLI
                    "", //TEL_CLI
                    "", //DIR_CLI
                    "", //OBS_CLI
                    "", //IVA_CLI
                    "", //CUI_CLI
                    0,  //NUEVO_CLI
                    "0   0", //CMAP
                    0, //REPARTIDOR
                    "", //REPART_NOM
                    "",  //HORA_REP
                    (float)21, //TASAIVA
                    0, //CONTROL
                    "", //NRO_CTR
                    "", //OBSERVA
                    "", //HORA_ENT
                    "", //FECHA_ENT
                    "", //TURNO_ENT
                    (float)$total, //PAGA_CON
                    0, //POSTRE
                    "", //COD_FOR1
                    "", //COD_FOR2
                    "", //COD_FOR3
                    "", //COD_FOR4
                    "", //COD_FOR5
                    "", //COD_FOR6
                    (float)0, //IMP1
                    (float)0, //IMP2
                    (float)0, //IMP3
                    (float)0, //IMP4
                    (float)0, //IMP5
                    (float)0, //IMP6
                    "la", //DET_FOR
                    1, //TOT_PER
                    '1', //ADICIONADA
                    0, //LISTA
                    0, //BOTGRUPO
                    "reserva", //RESERVA
                    (float)0, //ESTADO
                    "18:18",  //ULTHOR
                    "321", //SENA
                    1,  //FORMACOBRO
                    TRUE //AVISO
                ]; //Arreglo para insertar en la base vfp
                if (dbase_add_record($db, $datos_pedido)) {
                    dbase_close($db);
                    $pedido->sync = 1; // Inserto en la base mysql si pude sincronizar el pedido con maxirest o no
                    $pedido->save();
                } else {
                    throwException('No se pudo sincronizar el pedidos con maxirest');
                }
    
                $this->detalle_pedido_vfp($pedido_id);
                $info = ['error' => FALSE, 'mensaje' => 'El pedido se sincronizo exitosamente con Maxirest'];
            }else{
                throwException('El pedido ya fue sincronizado previamente');
            }
        }catch (Exception $e){
            $info = ['error' => true, 'mensaje' => $e];
        }
    
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('hindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'info' => $info
        ]);
        
    }
    
    private function detalle_pedido_vfp($pedido_id)
    {
        $path = self::PATH_MAXIREST_DETALLE_PEDIDOS_DB_FILE;
        $db = dbase_open($path, 2);
        $cont = 1;
        $productos_pedidos = PedidoDetalle::find()->where(['pedido_id' => $pedido_id])->all();
        foreach ($productos_pedidos as $producto_pedido){
            $producto = Producto::find()->where(['id' =>  $producto_pedido->producto_id])->one();
            $nombre_producto = $producto->nombre;
            $cod_articulo = $producto->id;
            $cant_linea = $producto_pedido->cantidad;
            $precio_linea = $producto_pedido->precio_linea;
            $precio_producto = $producto->precio_unitario;
            $detalle_pedido = [
                ""   , // COD_CTV
                1   , // MESA
                $cant_linea   , // CANTIDAD
                $cod_articulo  , // COD_ART
                $nombre_producto , // NOMBRE
                $precio_producto  , // PRECIO
                ""  , // DETALLE
                0   , // PRE_FUS
                0   , // CAN_FUS
                1   , // COD_RUA
                ""  , // AGREGADOS
                ""  , // SACADOS
                ""  , // TEXTO
                ""  , // HORA
                ""  , // HORA_CHK
                ""  , // CANT_CHK
                $pedido_id  , // COD_COMAND
                $pedido_id  , // NRO_COMAND
                $pedido_id   , // NRO_COMAN2
                $pedido_id   , // NRO_COMAN3
                $cont   , // ORDEN
                $cont   , // PADRE
                0   , // HIJO
                ""  , // TIPO_REL
                0   , // TILDADO
                ""  , // REL_MVS
                0   , // PUNTOS
                0   , // COMENZAL
                0   , // COD_DTO
                0   , // IMP_DTO
            ];
            $cont++;
            dbase_add_record($db,$detalle_pedido);
        }
        dbase_close($db);
    } //Guarda el detalle de un pedido en la base VFP
    
    public function actionConfirm($id)
    {
        $modelPedido = $this->findModel($id);

        if ($modelPedido->load(Yii::$app->request->post()) && $modelPedido->save() ) {

            $modelPedido->confirmado = 1;
            $modelPedido->save();
            //$result =1 ;
            $result = $this->mandarMailConfirmacion($modelPedido);
            if ($result) {
                $info = ['estado' => true, 'mensaje' => 'El pedido quedo confirmado y se envio la confirmacion al cliente'];
            }else{
                $info = ['estado' => false, 'mensaje' => 'No se pudo enviar un correo de confirmacion al cliente'];
            }
            
            $searchModel = new PedidoSearch();
            $dataProviderSinComandas = $searchModel->searchSinComandas(Yii::$app->request->queryParams);
            
            return $this->render('index',[
                'info' => $info,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProviderSinComandas,
            ]);
        } else {

            return $this->render('confirm', [
                'model' => $modelPedido
            ]);
        }

    }

    private function mandarMailConfirmacion($modelPedido)
    {
        $response = false;
        $clienteMail = $modelPedido->getClienteMail();
        $horaDeEntrega = $modelPedido->getHoraEntrega();
        if (empty($horaDeEntrega)) {
            $horaDeEntrega = '10:00 AM';
        }
        $fechaDeEntrega = new \DateTime($modelPedido->fecha_entrega);
        $total = $modelPedido->getTotalPedido();
        $total = Yii::$app->formatter->asCurrency($total);
        $precioEnvio = Yii::$app->formatter->asCurrency($modelPedido->flete_valor);
        if ($modelPedido->facturable == 1) {
            $facturable = 'y será facturado al 21%.';
        }else{
            $facturable = 'y no será facturado';
        }
            
        if (!empty($clienteMail)) {

            $mail = Yii::$app->mailer->compose()
                ->setFrom('pedidos@prosperovelazco.com')
                ->setTo($clienteMail)
                ->setTextBody('SGC')
                ->setSubject('Confirmación de Pedido')
                ->setHtmlBody(
                      " El pedido Numero $modelPedido->id fue confirmado exitosamente."
                    . " El costo del flete será de <b> {$precioEnvio} </b>."
                    . "<br>"        
                    . " Por lo que el costo final del Pedido será de <b> $total </b> $facturable"
                    . "<br>"                            
                    . " El pedido será entregado el día {$fechaDeEntrega->format('d/m/Y')} a la/s $horaDeEntrega. "
                    . "<br>"
                    . "<footer> "
                    . "<p>Sistema de Gestion de Comandas: <b> Próspero Velazco </b> </p> "
                    . "<br>"
                    . "<p>Ante cualquier duda, contactarse con: "
                    . "<a href='mailto:info@prosperovelazco.com.ar'>  info@prosperovelazco.com.ar </a> </p>"
                    . "</footer> ");
            $response = $mail->send();
        }
        
        return $response;
    }

    public function actionGetClienteDireccion()
    {
        $response = ['rta' => false];
        $id = (int) Yii::$app->request->getQueryParam('id');
        $cliente = Cliente::find()->where(['id' => $id])->asArray()->one();
    
        if (!empty($cliente)){
            $response = ['rta' => true, 'results'=>$cliente];
        }
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;

    }



/**
     * Auditoria
     * @return mixed
     */
    public function actionAudit(){
        $searchModel = new AuditEntrySearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $submodelo = new AuditTrailSearch;
        //$submodelo->unsetAttributes(); // clear any default values
        $submodelo->entry_id = $dataProvider->id; // IMPORTANTE!!!
        if (isset($_GET['Trail'])) {
                $submodelo->attributes = $_GET['Trail'];
        }
        return $this->render('audit', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'submodelo' => $submodelo,
        ]);
   }
    private function crearPdf($model,$form,$css=null)
    {
        $pedido_id = $model->id;
        $date = new \DateTime();
        $fecha =   $date->format('d-m-Y');
        $pdf = new Pdf ( [
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => $css ? $css : '@app/web/css/print/informe.css',
            'content' => $this->renderPartial($form,[
                'model' => $model,
            ]),
            'options' => [
                'title' => 'Forestal Pico: Sistema de Gestión de Pedidos'
            ],
            'methods' => [
                'SetHeader' => ['Forestal Pico: Sistema de Gestión de Pedidos'.'<BR>Pedido Nro: '.$pedido_id.' - Fecha: '.$fecha	],
                'SetFooter' => ['Pedido Nro: '.$pedido_id.' - Página {PAGENO}'],
            ]
        ] );
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        return $pdf->render ();
    }
    
    public function actionPrint(){
        $pedido_id = Yii::$app->request->get('id');
        $model_pedido = Pedido::find()->where(['id' => $pedido_id])->one();
        $form = '_print_expedicion';
        $css =  '@app/web/css/print/expedicion.css';
        $this->crearPdf($model_pedido,$form,$css);
        
    }
    
    
}