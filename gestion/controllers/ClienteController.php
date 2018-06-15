<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\models\Log;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\componets;
use app\models\Producto;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use app\models\ProductoRol;
use app\models\Rol;
use app\models\ClienteRol;
/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $model =  $this->findModel($id);

      $searchModel = new ClienteSearch();
      $dataProvider = $searchModel->searchProductos($model);

      return $this->render('view', [
          'model' => $model,
          'dataProvider' => $dataProvider
      ]);
    }

    public function actionEditEmail()
    {
        $post = Yii::$app->request->post();
        $mail = $post['email']; 
        $id = $post['id']; 
        $rta = array();


        try {
            if (empty($mail)) {
                throw new \Exception('Mail vacío.');
            }      
            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === FALSE) {
                throw new \Exception("La dirección de correo ( $mail ) no es válida."); 
            } 
            $model = $this->findModel($id);
            if (!empty($model)) {
                $model->email = $mail;
                if ($model->save()) {     
                    //Mensaje tiene que se vacío para que se cierre el popover del editable
                    $rta =  array("rta" => 'ok', "message" =>'') ;        
                }
                else {
                    throw new \Exception("Error al guardar el email. Contacte al administrador"); 
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
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $clienteRol = new ClienteRol();
            $clienteRol->cliente_id = $model->id;
            $clienteRol->rol_id = Rol::DEFAULTROLID;
            $clienteRol->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelCliente = $this->findModel($id);
        $modelsProducto = $modelCliente->productos;
        $newIDs = [];

        if ($modelCliente->load(Yii::$app->request->post())) {
            if ($modelsProducto != NULL) {
              $oldIDs = ArrayHelper::map($modelsProducto, 'id', 'id');
              $modelsProducto = Producto::createMultiple(Producto::classname(), $modelsProducto);   //carga todos los productos seleccionados
              Model::loadMultiple($modelsProducto, Yii::$app->request->post());
            }else {
              $oldIDs = [];
            }

            if (!empty($_POST['Producto'][0])){
              foreach ($_POST['Producto'] as $productoNuevos){
                $newIDs[] = (int) $productoNuevos['producto_id'];
              }
            }
            $deletedIDs = array_diff($oldIDs,$newIDs);
            $newIDs = array_diff($newIDs,$oldIDs);
            // validate all models
            $valid = $modelCliente->validate();
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                      if (!empty($deletedIDs)) {
                        $this->quitarProductos($deletedIDs,$modelCliente);
                      }

                      if (!empty($newIDs)) {
                        $this->agregarProductos($newIDs,$modelCliente);
                      }

                      if ($modelCliente->save()) {
                        $transaction->commit();
                      }else{
                        throw new Exception("Ocurrio un error durante el guardado del Cliente");
                      }

                      return $this->redirect(['view','id' => $modelCliente->id]);
                }
                catch (\Exception $e) {
                    $transaction->rollBack();
                    return $this->render('update', [
                        'model' => $modelCliente,
                        'modelsProductos' => (empty($modelsProducto)) ? [new Producto] : $modelsProducto,
                        'error' => $e->getmessage()
                    ]);
                }
            }
        }
        return $this->render('update', [
            'model' => $modelCliente,
            'modelsProductos' => (empty($modelsProducto)) ? [new Producto] : $modelsProducto
        ]);
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateWeb($id)
    {
      $model = $this->findModel($id);
      $Laerror = null;
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $response = $this->saveWebUser($model);
          $error = $this->createWebRol($model);
          $this->syncProductos($model);
          $searchModel = new ClienteSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
              'error' => $error,
          ]);
      } else {
          return $this->render('create-web', [
              'model' => $model,
          ]);
      }
    }

    protected function saveWebUser($model)
    {
      $mensaje = ['error' => true, "mensaje" => 'Ocurrio un error durante la sincronizacion'];

      $customer =   [
                      'username' => $model->usuario_web,
                      'password' => $model->password_web,
                      'email' => $model->email,
                      'first_name' => $model->nombre,
                      'last_name' => $model->apellido
                    ];

      $response = Yii::$app->woocomponent->newCliente($customer);

      if ($response['error'] != true){
        $model->web_customer_id = $response['mensaje']['id'];
        $model->save();
        $mensaje = ['error' => false, "mensaje" => 'Se creó el usuario correctamente'];
      }else{
        $cliente = Yii::$app->woocomponent->getClienteMail($model->email);
        if (empty($cliente)) {
          $mensaje = ['error' => true, "mensaje" => 'No se encontro el usuario web'];
        }
        $model->web_customer_id = $cliente[0]['id'];
        $model->save();
        $password = ['password' => $model->password_web,'email' => $model->email ];
        $response = Yii::$app->woocomponent->updateCliente($model->web_customer_id,$password);
        $mensaje = ['error' => false, "mensaje" => 'Se actualizó el usuario web'];
      }
      return $mensaje;
    }

    protected function createWebRol($model)
    {
      $mensaje = ['error' => true, "mensaje" => 'Ocurrio un error durante la sincronizacion'];
      try {
        $cliente_id = $model->id;
        $web_id = $model->web_customer_id;

        $rol = $model->getClienteRol();

        if (!empty($web_id)) {
          if (!Yii::$app->WordpressApi->rolExist($rol->nombre)){
            Yii::$app->WordpressApi->newRol($rol->nombre);       //Creo el rol en Wordpress
          }

          if(!Yii::$app->WordpressApi->clientHasRol($rol->nombre,$web_id)){ //Funcion que hay que desarrollar todavia
            Yii::$app->WordpressApi->newClientRol($rol->nombre,$web_id); //Creo el rol en Wordpress
          }
        }

        $mensaje =  ['error' => false, "mensaje" => 'La sincronizacion se realizo correctamente.'];

      } catch (\Exception $e) {
        $mensaje = ['error' => true, "mensaje" => $e->getmessage() ];
      }

      return $mensaje;
    }

    private function agregarProductos($newIDs,$modelCliente)
    {
      $rol = $modelCliente->getClienteRol();
      foreach ($newIDs as $nuevoID){                // -- Creo la nueva relacion Cliente - Producto
          $productoRol = new ProductoRol();
          $productoRol->producto_id = $nuevoID;
          $productoRol->rol_id = $rol->id;
          if (!$productoRol->save()) {
            throw new \Exception('No se pudo agrega el producto al cliente');
          }
          $pubicProduct = ProductoRol::find()->where(['producto_id' => $nuevoID, 'rol_id' => Rol::DEFAULTROLID])->one();
          if (!empty($pubicProduct)){ //Si estaba publico,lo borro, para ser consistente con la base de datos de Woocomerce
            $pubicProduct->delete();
          }
          if (!empty($modelCliente->web_customer_id)){     //-- Seteo los roles nuevos para los productos web
            $producto = Producto::find()->where(['id' => $nuevoID])->one();
            $web_id = $producto->web_id;
            if (empty($web_id)) {
              ProductoController::creatWebProduct($producto);
              $web_id = $producto->web_id;
            }          
            $rolename = $rol->nombre;
            if (!Yii::$app->WordpressApi->newProductRol($rolename,$web_id)) {
              throw new Exception('No se pudo agrega el producto al cliente, ocurrio un error al conectarse a la web');
            }
          }
      }
    }

    private function quitarProductos($deletedIDs,$modelCliente)
    {
      $rol = $modelCliente->getClienteRol();
      foreach ($deletedIDs as $deletedID){
        if(!ProductoRol::find()->where(['producto_id' => $deletedID, 'rol_id' => $rol->id])->one()->delete()){
          throw new Exception('No se pudieron quitar los productos especiales del cliente');
        }
        if (!empty($modelCliente->web_customer_id)){     //-- Quito los permisos al usuario de ver este producto
        $producto = Producto::find()->where(['id' => $deletedID])->one();
        $web_id = $producto->web_id;
        $rolename = $rol->nombre;
          if(!Yii::$app->WordpressApi->deleteProductoRol($rolename,$web_id)){
            throw new Exception('No se pudieron quitar los productos especiales del cliente, ocurrio un error al conectarse a la web');
          }
        }
        if (empty(ProductoRol::find()->where(['producto_id' => $deletedID])->all())){ //Si ya no le quedan roles al producto le asigno el de customer, para ser consistente con Woocomerce
          $productoRol = new ProductoRol();
          $productoRol->producto_id = $deletedID;
          $productoRol->rol_id = Rol::DEFAULTROLID;
          if (!$productoRol->save()) {
            throw new Exception('No se pudo agrega el producto al cliente');
          }
        }
      }
    }

    private function syncProductos($modelCliente)
    {
      $productos= $modelCliente->productos;
      $productosID = [];
      foreach ($productos as $producto){
        $productosID[] = $producto->id;
      }
      $this->agregarProductos($productosID,$modelCliente);
    }
}
