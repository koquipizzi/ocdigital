<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoRol;
use app\models\Rol;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPindex()
    {
        $searchModel = new ProductoSearch();
        $dataProviderSinRoles = $searchModel->searchSinRoles(Yii::$app->request->queryParams); //Mejorar Search

        return $this->render('Pindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProviderSinRoles,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setDefaultRol([$model->id]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->creatWebProduct($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Producto model.
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function creatWebProduct($model)
    {
      $product= [ 'name' => $model->nombre,
                  'type' => 'simple',
                  'regular_price' => $model->precio_unitario,
                  'categories' => [
                                      [
                                          'id' => $model->getProductoCatWebID(),
                                      ]
                                  ]
                ];
        if (!empty($model->web_id)){
          Yii::$app->woocomponent->updateProducto($product,$model->web_id);
        }else{
          $response = Yii::$app->woocomponent->newProducto($product);
          if (!empty($response)) {
              $model->web_id = $response['id'];
              $model->save();
          }
        }
    }

    public function actionSync()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $products = Producto::getProductosActivos();

        try {
            foreach ($products as $product ) {
              $model = $this->findModel($product['id']);
              $this->creatWebProduct($model);
            }
            $info = array("error" => false,"mensaje" =>'Los productos se sincronizaron correctamente');
        }catch(\Exception $e) {
            $info = array("error" => true,"mensaje" =>'Los productos no se pudieron sincronizar correctamente');
        }

        return $this->renderIndex($info);
    }

    public function actionSetrol() //Setea los productos para todos los usuarios
    {
      $productos = Yii::$app->request->post('selection');
      if (empty($productos)){
        $info = ["error" => true, "mensaje" =>'No se seleccionaron productos'];
      }else{
        $this->setDefaultRol($productos);
        $info = ["error" => false, "mensaje" =>'Se agregaron los nuevos productos'];
      }
      return $this->renderIndex($info);
    }

    private function setDefaultRol($productos)
    {
      foreach ($productos as $producto ) {
        $productoRol = new ProductoRol();
        $productoRol->producto_id = $producto;
        $productoModel = Producto::find()->where(['id' => $producto])->one();
        if (!empty($productoModel->web_id)) {
          $this->resetProducto($productoModel);
        }
        $rol = Rol::find()->where(['defecto' => Rol::DEFAULTROLID])->one();
        $productoRol->rol_id = $rol->id ;
        $rolename = $rol->nombre;
        if(!$productoRol->save()){
          throw new Exception('No se pudo guardar el Producto Correctamente');
        }
      }
    }

    public function actionQuitarProducto($id) //Oculta el Producto, para no ser vendido
    {
      $model = $this->findModel($id);
      try {
        $this->quitarRoles($id);
        $ProductoRol = new ProductoRol;
        $ProductoRol->producto_id =  $id;
        $ProductoRol->rol_id =   Rol::HIDDENROLID;
        if (!$ProductoRol->save()) {
          throw new \Exception('No se pudo ocultar el productos  a los clientes del sistema');
        }
        if (!Yii::$app->WordpressApi->hideProduct($model->web_id)){
          throw new \Exception('No se pudo ocultar el productos  a los clientes web');
        }
        $info = ["error" => false,"mensaje" => 'Se quito el producto de la venta'];
      }catch (\Exception $e){
        $info = ["error" => true,"mensaje" => $e->getmessage()];
      }

    return $this->renderIndex($info);
    }

    private function quitarRoles($id)
    {
      $model = $this->findModel($id);
      $IDRoles = [];
      $IDRolesWeb = [];
      $RolesProductos = ProductoRol::find()->where(['producto_id' => $id])->all();
      foreach ($RolesProductos as $RolProducto){
        if ($RolProducto->rol_id != Rol::DEFAULTROLID ) {
          $IDRolesWeb[] = $RolProducto->rol_id;
        }
          $IDRoles[] = $RolProducto->rol_id;
      }
      $roles = Rol::find()->where(['in','id',$IDRoles])->all();
      $rolesWeb = Rol::find()->where(['in','id',$IDRolesWeb])->all();
      foreach ($roles as $rol) {
        if(!ProductoRol::deleteAll(['producto_id' => $id, 'rol_id' => $rol->id])){
          throw new \Exception('No se pudieron quitar el producto en nuestra base de datos');
        }
      }
      foreach ($rolesWeb as $rolWeb) {  //
        if (!Yii::$app->WordpressApi->deleteProductoRol($rolWeb->nombre,$model->web_id)){
          throw new \Exception('No se pudieron quitar los productos  de la venta en  la web');
        }
      }
    }

    private function resetProducto($ModelProducto)
    {
      $this->quitarRoles($ModelProducto->id);
      if (!Yii::$app->WordpressApi->deleteProductoRol('hidden',$ModelProducto->web_id)){
        throw new \Exception('No se pudieron quitar los productos  de la venta en  la web');
      }
    }

    private function renderPendientesIndex($mensaje)
    {
      $searchModel = new ProductoSearch();
      $dataProviderSinRoles = $searchModel->searchSinRoles(Yii::$app->request->queryParams); //Mejorar Search

      return $this->render('Pindex', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProviderSinRoles,
          'info' => $mensaje
      ]);
    }

    private function renderIndex($mensaje)
    {
      $searchModel = new ProductoSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'info' => $mensaje
      ]);
    }
    
    public function actionGetDetalles(){
        $idProducto = Yii::$app->getRequest()->get('id');
        $response = ['rta' => false];
        if (!empty($idProducto)){
            $producto = Producto::find()->where(['id' => $idProducto])->asArray()->one();
            if  (!empty($producto)){
                $response = ['rta' => true, 'data' => $producto];
            }
        }
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $response;
    }


}
