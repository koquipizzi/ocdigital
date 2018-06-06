<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Comanda;
use app\models\ComandaSearch;
use app\models\ComandaDetalle;
use app\models\ComandaDetalleSearch;
use app\models\Pedido;
use app\models\PedidoSearch;
use app\models\PedidoDetalle;
use kartik\mpdf\Pdf;
use app\components;

/**
 * ComandaController implements the CRUD actions for Comanda model.
 */
class ComandaController extends Controller
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
     * Lists all Comanda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComandaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comanda model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $searchModel = new ComandaDetalleSearch();
        $dataProvider = $searchModel->searchComandaId($model->id);
        $searchModel = new PedidoSearch();
        $dataProviderPedido = $searchModel->searchPedidosComanda($model->id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderPedido' => $dataProviderPedido
        ]);
    }

     /**
     * Displays a single Comanda model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewPedidos($id)
    {
        $model = $this->findModel($id);
        $searchModel = new ComandaDetalleSearch();
        $dataProvider = $searchModel->searchComandaId($model->id);
        $searchModel = new PedidoSearch();
        $dataProviderPedido = $searchModel->searchPedidosComanda($model->id);
        return $this->render('_comandas_logistica', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderPedido' => $dataProviderPedido
        ]);
    }

    /**
     * Creates a new Comanda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comanda();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comanda model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new ComandaDetalleSearch();
        $dataProvider = $searchModel->searchComandaId($model->id);
        $searchModel = new PedidoSearch();
        $dataProviderPedido = $searchModel->searchPedidosComanda($model->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //die('eeed');
            $searchModel = new ComandaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $info = [
                'mensaje' =>  "Se guardaron los cambios en la comanda",
                'estado' => true
             ];
           //  return $this->redirect('index');
            return $this->render('index', [
                //    'model' => $modelComanda,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
              //      'info'=> $info
                ]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'dataProviderPedido' => $dataProviderPedido
            ]);
        }
    }

    /**
     * Deletes an existing Comanda model.
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
     * Finds the Comanda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comanda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comanda::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAsignarComanda($id)
    {
      $ultima_comanda = Comanda::find()->orderBy(['id'=> SORT_DESC])->one();
      if (!empty($ultima_comanda)){
	      $comanda_id = $ultima_comanda['id'];
      }else{
	      $comanda = new Comanda();
	      $comanda->save();
	      $comanda_id = $comanda->id;
      }
      
      $this->agregarPedidosComanda($id,$comanda_id);

      return $this->redirect(['index']);
    }

    private function agregarPedidosComanda($pedido_id,$comanda_id)
    {
      $modelPedido = new Pedido();
      $pedido = $modelPedido->find()->where(['id' => $pedido_id])->one();
      if ($pedido->confirmado) {

        $pedido->comanda_id = $comanda_id;
        $pedido->save();

        //por cada pedido miro los productos
        $pedidoDetalles = $pedido->getPedidoDetalles();
        $modelPedidoDetalle = new PedidoDetalle();
        $detalles = $modelPedidoDetalle->find()->where(['pedido_id' => $pedido_id])->all();

        foreach ($detalles as $pedidoDetalle){
            $comandaDetalle = new ComandaDetalle();
            $comandaDetalle->cantidad_produccion = $pedidoDetalle->cantidad;
            $comandaDetalle->comanda_id = $comanda_id;
            $comandaDetalle->producto_id = $pedidoDetalle->producto_id;
            $comandaDetalle->save();
        }

        $ultimo_estado = $pedido->estado;
        $estado = Pedido::ESTADO_COMPLETADO;
        $pedido->estado = $estado;
        if ($ultimo_estado != Pedido::ESTADO_MANUAL ) {
            $WCEstado = Yii::$app->woocomponent->setEstado($pedido->web_id,$estado);
        }

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $date = new \DateTime();
        $pedido->fecha_produccion = $date->format('Y-m-d H:i') ;
        $pedido->save();
      }
    }

    public function actionNewComanda($id = null)
    {

        if (empty(Yii::$app->request->post('selection')))
        {
            $model = new Pedido();
            $searchModel = new PedidoSearch();
            $dataProviderSinComandas = $searchModel->searchSinComandas(Yii::$app->request->queryParams);
            $info = [
                'mensaje' => "Debe seleccionar los pedidos para crear una comanda.",
                'estado' => false
             ];
            return $this->render('../pedido/index', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProviderSinComandas,
                    'info'=> $info
                ]);
            die();
        }


        if (!empty(Yii::$app->request->post('selection'))){
            $pedidos_id = Yii::$app->request->post('selection');
            $comanda = new Comanda();
            $comanda->save();
            foreach ($pedidos_id as $pedido_id) {
                $this->agregarPedidosComanda($pedido_id,$comanda->id);
            }

            $searchModel = new ComandaDetalleSearch();
            $dataProvider = $searchModel->searchComandaId($comanda->id);
            return $this->redirect(['comanda/update','id'=>$comanda->id]);
        }
        else { //si viene desde update Comanda
            $model = $this->findModel($id);
            $searchModel = new ComandaDetalleSearch();
            $dataProvider = $searchModel->searchComandaId($model->id);
            if (Yii::$app->request->post()){
                $datos = Yii::$app->request->post();
                //Formateo la fecha
                $FP = new \DateTime($datos['Comanda']['fecha_produccion']);
                $datos['Comanda']['fecha_produccion'] = $FP->format('Y-m-d h:s');
                //Formateo la fecha
                if ($model->load($datos) && $model->save()) {
                    $info = 'La comanda ha sido actualizada';
                    return $this->render('update', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'info'=> $info
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
    }

    private function crearPdf($model,$form,$dataProvider,$searchModel,$css=null)
    {
        $comandas = $model->id;
        $date = new \DateTime($model->fecha_produccion);
        $fecha =   $date->format('d-m-Y');
        $pdf = new Pdf ( [
             'mode' => Pdf::MODE_CORE,
         //   'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => $css ? $css : '@app/web/css/print/informe.css',
            // any css to be embedded if required
            //'cssInline' => '* {font-size:14px;}',
            // set mPDF properties on the fly

            'content' => $this->renderPartial($form,[
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
            'options' => [
                'title' => 'Próspero Velazco: Sistema Gestión de Comandas'
            ],
            'methods' => [
                'SetHeader' => ['PRÓSPERO VELAZCO: Sistema Gestión de Comandas'.'<BR>Comanda Nro: '.$comandas.' - Fecha: '.$fecha	],
                'SetFooter' => ['Comanda Nro: '.$comandas.' - Página {PAGENO}'],
            ]
        ] );



        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        return $pdf->render ();
    }


    private function crearPdfCategorias($model,$form,$searchModel)
    {
        $comandas = $model->id;
        $date = new \DateTime($model->fecha_produccion);
        $fecha =   $date->format('d-m-Y');
        $pdf = new Pdf ( [
            'mode' => Pdf::MODE_CORE,
            // 'mode' => Pdf::MODE_BLANK,
          //  'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@app/web/css/print/informe.css',
            // any css to be embedded if required
            //'cssInline' => '* {font-size:14px;}',
            // set mPDF properties on the fly

            'content' => $this->renderPartial($form,[
                'model' => $model,
                'searchModel' => $searchModel
            ]),
            'options' => [
                'title' => 'Próspero Velazco: Sistema Gestión de Comandas'
            ],
            'methods' => [
                'SetHeader' => ['PRÓSPERO VELAZCO: Sistema Gestión de Comandas'.'<BR>Comanda Nro: '.$comandas.' - Fecha: '.$fecha	],
                'SetFooter' => ['Comanda Nro: '.$comandas.' - Página {PAGENO}'],
            ]
        ] );

      /*------------------------------------*/
        Yii::$app->response->headers->add("Location", "/");
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
        /*------------------------------------*/

        return $pdf->render ();
    }


    public function actionImprimirComandas($id)
    {
      if (($model = $this->findModel($id)) !== null) {
        $searchModel = new ComandaDetalleSearch();
        $dataProvider = $searchModel->searchComandaId($model->id);
        $form = '_print_comandas';
        $css =  '@app/web/css/print/informeReducido.css';
        $this->crearPdf($model,$form,$dataProvider,$searchModel,$css);
      } else {
          throw new NotFoundHttpException('The requested page does not exist.');
      }
    }

    public function actionGetAction()
    {
      if (isset($_POST['new-comanda'])) {
        return $this->actionNewComanda();
      } else if (isset($_POST['alter-comanda'])) {
        return $this->actionAlterComanda();
      }
    }

    public function actionAlterComanda()
    {
      if (!empty(Yii::$app->request->post('selection'))){
          $pedidos_id = Yii::$app->request->post('selection');
          foreach ($pedidos_id as $pedido_id) {
            $this->actionAsignarComanda($pedido_id);
          }
      }else{
        $model = new Pedido();
        $searchModel = new PedidoSearch();
        $dataProviderSinComandas = $searchModel->searchSinComandas(Yii::$app->request->queryParams);
        $info = [
            'mensaje' => "Debe seleccionar los pedidos a agregar a la ultima comanda.",
            'estado' => false
         ];
        return $this->render('../pedido/index', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProviderSinComandas,
                'info'=> $info
            ]);
      }
    }

    public function actionImprimircatComandas($id)
    {
        if (($model = $this->findModel($id)) !== null) {
            $searchModel = new ComandaDetalleSearch();
            $form = '_print_catcomandas';
            $this->crearPdfCategorias($model, $form, $searchModel);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function crearPdfLogistica($model,$vista,$searchModel)
    {
        $comandas = $model->id;
        $date = new \DateTime($model->fecha_produccion);
        $fecha =   $date->format('d-m-Y');
        $pdf = new Pdf ( [
            'mode' => Pdf::MODE_CORE,
            // 'mode' => Pdf::MODE_BLANK,
          //  'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@app/web/css/print/informe.css',
            // any css to be embedded if required
            //'cssInline' => '* {font-size:14px;}',
            // set mPDF properties on the fly

            'content' => $this->renderPartial($vista,[
                'model' => $model,
                'searchModel' => $searchModel
            ]),
            'options' => [
                'title' => 'Próspero Velazco: Sistema Gestión de Comandas'
            ],
            'methods' => [
                'SetHeader' => ['PRÓSPERO VELAZCO: Sistema Gestión de Comandas'.'<BR>Comanda Nro: '.$comandas.' - Fecha: '.$fecha	],
                'SetFooter' => ['Comanda Nro: '.$comandas.' - Página {PAGENO}'],
            ]
        ] );

      /*------------------------------------*/
        Yii::$app->response->headers->add("Location", "/");
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
        /*------------------------------------*/

        return $pdf->render ();
    }

    public function actionImprimirLogistica($id)
    {
        if (($model = $this->findModel($id)) !== null) {
            $searchModel = new ComandaDetalleSearch();
            $vista = '_print_comandas_logistica';
            $this->crearPdfLogistica($model, $vista, $searchModel);

        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
