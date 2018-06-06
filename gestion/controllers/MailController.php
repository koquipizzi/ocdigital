<?php

namespace app\controllers;

use Yii;
use app\models\Mail;
use app\models\MailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\validators\EmailValidator;


/**
 * MailController implements the CRUD actions for Mail model.
 */
class MailController extends Controller
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
     * Lists all Mail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MailSearch();
        $modelo = new Mail();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $modelo,
        ]);
    }

    /**
     * Displays a single Mail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAdd()
    {      
        $model = new Mail();

        $post = Yii::$app->request->post('Mail');
        $id = $post['evento']; 
        $mails = $post['mails'];      
        $count = 0;
        $rta = array();

        try {
            if (empty($mails)) {
                throw new \Exception('Mail vacío.');
            }      
            if (filter_var($mails, FILTER_VALIDATE_EMAIL) === FALSE) {
                throw new \Exception("La dirección de correo ( $mails ) no es válida."); 
            } 
            $model = Mail::findOne($id);
            $emails = $model->mails;           
            if (isset($mails)) {
                $emails = $emails.";".$mails;
                $model->mails = $emails;
                if ($model->save()) {  
                    $rta =  array("rta" => 'ok', "message" =>'Mail Agregado') ;        
                }
            }
          
        } catch (\Exception $e) { 
            $e = $e->getMessage();
            $error = true;         
          //  $mensaje = "Error al guardar en la Base de Datos. Contacte al administrador";
            $rta = array('error' => $error, 'message' => $e);
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
        return $rta;


        
    }

    public function actionEdit()
    {       
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Mail();

        $post = Yii::$app->request->post();
        $key= $post['key']; 
        $mail = $post['mail']; 
        $id = $post['id']; 
        $rta = array();


        try {
            if (empty($mail)) {
                throw new \Exception('Mail vacío.');
            }      
            if (filter_var($mail, FILTER_VALIDATE_EMAIL) === FALSE) {
                throw new \Exception("La dirección de correo ( $mail ) no es válida."); 
            } 
            $model = Mail::findOne($id);
            if (!empty($model)) {
                $emails = $model->mails;
                $mails = explode(';', $emails);
                $mails[$key] = $mail;
                $mailsJuntos = implode(';',$mails);
                $model->mails = $mailsJuntos;
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

    public function actionBorrar()
    {       
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new Mail();

        $post = Yii::$app->request->post();
        $key= $post['key']; 
        $mail = $post['mail']; 
        $id = $post['id']; 
        $rta = array();

        $model = $this->findModel($id);

        if ($model !== null) {
            $emails = $model->mails;
            $mails = explode(';', $emails);
            //borra el elemento
            unset($mails[$key]);
            $mailsJuntos = implode(';',$mails);
            $model->mails = $mailsJuntos;
            if ($model->save()) {           
                $rta = array("rta" => 'ok', "message" =>'Elemento Eliminado.');        
            } else {    
                $rta = array("rta" => 'error',"message" =>$model->getErrors()) ; 
            }
        }
        return $rta ;
    }
}

