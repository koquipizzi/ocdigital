<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;
use yii\db\Expression;

/**
 * PedidoSearch represents the model behind the search form about `app\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    public $razon_social;
    public $estado_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'web_id', 'cliente_id', 'comanda_id'], 'integer'],
            [['fecha_hora', 'fecha_produccion', 'fecha_entrega', 'ship_company', 'ship_address_1', 'ship_address_2', 'ship_city', 'ship_state', 'ship_postcode', 'ship_country', 'estado','estado_id'], 'safe'],
            [['precio_total'], 'number'],
            [['razon_social'], 'string', 'max' => 255]
        ];
    }

    private function fechaPedidoFilter($param, &$where, &$queryParams) {
        if(isset($param)) {
            list($fechaInicio,$fechaFin)= explode('-',$param);
            $queryParams[':fecha_inicio_fe'] = trim($fechaInicio);
            $queryParams[':fecha_fin_fe']    = trim($fechaFin);
            $where = $this->addWhereSentence($where, "Protocolo.fecha_entrada BETWEEN STR_TO_DATE(:fecha_inicio_fe,'%d/%m/%Y') AND STR_TO_DATE(:fecha_fin_fe,'%d/%m/%Y')");
        }
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    
    
    
    private function paramExists($params, $key) {
        return
         is_array($params)
         && array_key_exists($key, $params)
         && (!empty($params[$key]));
    }
    
    private function addWhereSentence($where, $sentence, $connector = 'AND') {
        if(empty($where))
            return $sentence;
        return " {$where} {$connector} {$sentence} ";
    }
    
    
    
    
    
    /**
     * Filtro de nro Pedido
     */
    private function nroPedidoFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'nro_pedido')) {
            $queryParams[':nro_pedido'] = "%".$params['nro_pedido']."%";
            $where = $this->addWhereSentence($where, " CONCAT(tipo.codigo,'-',pedido.nro_pedido) like :nro_pedido");
        }
    }
    
    /**
     * Filtro de nro Pedido_id
     */
    private function nroPedidoIdFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'id')) {
            $queryParams[':id'] = $params['id'];
            $where = $this->addWhereSentence($where, "pedido.id= :id");
        }
    }
    
    
    
    /**
     * Filtro de fecha entrega
     */
    private function fechaEntregaFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'fecha_entrega')) {
            list($fechaInicio,$fechaFin)= explode('-',$params['fecha_entrega']);
            $queryParams[':fecha_inicio'] = trim($fechaInicio);
            $queryParams[':fecha_fin']    = trim($fechaFin);
            $where = $this->addWhereSentence($where, "pedido.fecha_entrega BETWEEN STR_TO_DATE(:fecha_inicio,'%d/%m/%Y') AND STR_TO_DATE(:fecha_fin,'%d/%m/%Y')");
        }
    }
    
   
    /**
     * Filtro de razon_social
     */
    private function clienteNombreFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'razon_social')) {
            $queryParams[':razon_social'] = "%".$params['razon_social']."%";
            $where = $this->addWhereSentence($where, "cliente.razon_social like :razon_social");
        }
    }
    
    
    /**
     * Filtro de cliente_id
     */
    private function clienteIdFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'cliente_id')) {
            $queryParams[':cliente_id'] = $params['cliente_id'];
            $where = $this->addWhereSentence($where, "cliente.id = :cliente_id");
        }
    }
    
    
    
    
    /**
     * Filtro de razon social
     */
    private function clienteRazonSocialFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'razon_social')) {
            $queryParams[':razon_social'] = "%".$params['razon_social']."%";
            $where = $this->addWhereSentence($where, "cliente.razon_social like :razon_social");
        }
    }
    
    
    /**
     * Filtro de fecha entrega
     */
    private function fechaMinimaProduccionFilter($params, &$where, &$queryParams) {
        if($this->paramExists($params, 'fecha_minima_produccion')) {
            list($fechaInicio,$fechaFin)= explode('-',$params['fecha_minima_produccion']);
            $queryParams[':fecha_inicio_minima_produccion'] = trim($fechaInicio);
            $queryParams[':fecha_fin_minima_produccion']    = trim($fechaFin);
            $where = $this->addWhereSentence($where, "detalle_pedido.fecha_minima_produccion BETWEEN STR_TO_DATE(:fecha_inicio_minima_produccion,'%d/%m/%Y') AND STR_TO_DATE(:fecha_fin_minima_produccion,'%d/%m/%Y')");
        }
    }
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    
    public function searchPedidosEnEspera($params)
    {
        
        $queryParams = [];
        $where = 'pedido.estado_id =1';
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                     ON(pedido.cliente_id=cliente.id)
            JOIN user                        ON(pedido.gestor_id=user.id)
            JOIN estado                      ON(pedido.estado_id=estado.id)
        ';
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        

        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
      //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
         'sql' => $query,
         'params' => $queryParams,
         'sort' => [
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'razon_social',
                'nro_pedido',
                'fecha_entrega',
                'id' => [
                        'asc' => [new Expression('id')],
                        'desc' => [new Expression('id DESC ')],
                        'default' => SORT_DESC,
                ],
          ],
         ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }

    public function searchPedidosEnEsperaViajante($params)
    {
        $gestor = Yii::$app->user->getId();
        $queryParams = [];
        $where = 'pedido.estado_id =1 and gestor_id = '.$gestor;
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                      ON(pedido.cliente_id=cliente.id)
            JOIN user                      ON(pedido.gestor_id=user.id)
            JOIN estado                      ON(pedido.estado_id=estado.id)
        ';
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        

        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
      //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
         'sql' => $query,
         'params' => $queryParams,
         'sort' => [
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'razon_social',
                'nro_pedido',
                'fecha_entrega',
                'id' => [
                        'asc' => [new Expression('id')],
                        'desc' => [new Expression('id DESC ')],
                        'default' => SORT_DESC,
                ],
          ],
         ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }
    
    
    public function searchPedidosAceptados($params)
    {
        
        $queryParams = [];
        $where = 'pedido.estado_id =2';
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                      ON(pedido.cliente_id=cliente.id)
            JOIN user                         ON(pedido.gestor_id=user.id)
            JOIN estado                       ON(pedido.estado_id=estado.id)
        ';
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        

        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
      //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
         'sql' => $query,
         'params' => $queryParams,
         'sort' => [
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'razon_social',
                'nro_pedido',
                'fecha_entrega',
                'id' => [
                        'asc' => [new Expression('id')],
                        'desc' => [new Expression('id DESC ')],
                        'default' => SORT_DESC,
                ],
            ],
         ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }
    
    
    public function searchPedidosExpedicion($params)
    {
        
       
        $queryParams = [];
        $where = 'pedido.estado_id =3';
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                      ON(pedido.cliente_id=cliente.id)
            JOIN user                         ON(pedido.gestor_id=user.id)
             JOIN estado                      ON(pedido.estado_id=estado.id)
        ';
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        

        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
      //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
         'sql' => $query,
         'params' => $queryParams,
         'sort' => [
            'defaultOrder' => ['id' => SORT_DESC],
            'attributes' => [
                'razon_social',
                'nro_pedido',
                'fecha_entrega',
                'id' => [
                        'asc' => [new Expression('id')],
                        'desc' => [new Expression('id DESC ')],
                        'default' => SORT_DESC,
                ],
          ],
         ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }
    
    public function searchPedidosDespachados($params)
    {
        
       
        $queryParams = [];
        $where = 'pedido.estado_id =4';
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                      ON(pedido.cliente_id=cliente.id)
            JOIN user                         ON(pedido.gestor_id=user.id)
             JOIN estado                      ON(pedido.estado_id=estado.id)
        ';
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        

        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
      //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
            'sql' => $query,
            'params' => $queryParams,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'razon_social',
                    'nro_pedido',
                    'fecha_entrega',
                    'id' => [
                            'asc' => [new Expression('id')],
                            'desc' => [new Expression('id DESC ')],
                            'default' => SORT_DESC,
                    ],
                ],
            ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }
    
    public function searchTodos($params)
    {
        
        
        $queryParams = [];
        $where = '';
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                      ON(pedido.cliente_id=cliente.id)
            JOIN user                         ON(pedido.gestor_id=user.id)
            JOIN estado                       ON(pedido.estado_id=estado.id)
        ';
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        
        
        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
         'sql' => $query,
         'params' => $queryParams,
         'sort' => [
          'defaultOrder' => ['id' => SORT_DESC],
          'attributes' => [
           'razon_social',
           'nro_pedido',
           'fecha_entrega',
           'estado_id',
           'id' => [
            'asc' => [new Expression('id')],
            'desc' => [new Expression('id DESC ')],
            'default' => SORT_DESC,
           ],
          ],
         ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }
    
    
     public function searchPedidosCancelados($params)
    {
        
       
        $queryParams = [];
        $where = 'pedido.estado_id =5';
        $GROUP_BY ='';
        $formParams = [];
        if(array_key_exists('PedidoSearch',$params)) {
            $formParams = $params['PedidoSearch'];
        }
        
        $fieldList = "
             pedido.id
            ,pedido.fecha_entrega
            ,pedido.confirmado
            ,cliente.razon_social
            ,pedido.gestor_id
            ,pedido.estado_id as pedido_estado_id
            ,user.username
            ,estado.id as estado_id
        ";
        $fromTables = '
            pedido
            JOIN cliente                      ON(pedido.cliente_id=cliente.id)
            JOIN user                         ON(pedido.gestor_id=user.id)
             JOIN estado                      ON(pedido.estado_id=estado.id)
        ';
        
        
        
        $this->nroPedidoIdFilter($formParams, $where, $queryParams);
        
        $this->fechaEntregaFilter($formParams, $where, $queryParams);
        
        $this->clienteRazonSocialFilter($formParams, $where, $queryParams);
        
        
        if(!empty($where)) {
            
            $where = " WHERE {$where} ";
        }
        if(!empty($GROUP_BY)) {
            
            $GROUP_BY = " GROUP BY {$GROUP_BY} ";
        }
        

        
        $query = "
            SELECT {$fieldList}
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
      //  die($query);
        $consultaCant = "
            SELECT count(*) as total
            FROM {$fromTables}
            {$where}
            {$GROUP_BY}
        ";
        $itemsCount = Yii::$app->db->createCommand(
         $consultaCant,
         $queryParams
        )->queryScalar();
        
        $dataProvider = new \yii\data\SqlDataProvider([
            'sql' => $query,
            'params' => $queryParams,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'razon_social',
                    'nro_pedido',
                    'fecha_entrega',
                    'id' => [
                            'asc' => [new Expression('id')],
                            'desc' => [new Expression('id DESC ')],
                            'default' => SORT_DESC,
                    ],
                ],
            ],
         'totalCount' => $itemsCount,
         'key'        => 'id' ,
         'pagination' => [
          'pageSize' => 150,
         ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        return $dataProvider;
    }
    
    
    
    
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pedido::find()->join('INNER JOIN','cliente', 'cliente.id = pedido.cliente_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pedido.id' => $this->id,
            'fecha_hora' => $this->fecha_hora,
            'fecha_entrega' => $this->fecha_entrega,
            'fecha_produccion' => $this->fecha_produccion,
            'web_id' => $this->web_id,
            'comanda_id' => $this->comanda_id,
        //    'precio_total' => $this->precio_total,
        ]);

        $query->andFilterWhere(['like', 'ship_company', $this->ship_company])
            ->andFilterWhere(['like', 'ship_address_1', $this->ship_address_1])
            ->andFilterWhere(['like', 'ship_address_2', $this->ship_address_2])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_state', $this->ship_state])
            ->andFilterWhere(['like', 'ship_postcode', $this->ship_postcode])
            ->andFilterWhere(['like', 'ship_country', $this->ship_country])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'precio_total', $this->precio_total]);

        if(!empty($this->fecha_hora)) {
            list($fechaInicio,$fechaFin)= explode('-',$this->fecha_hora);
            $queryParams[':fecha_inicio'] = trim($fechaInicio);
            $queryParams[':fecha_fin']    = trim($fechaFin);
            if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                $query->where( "pedido.fecha_hora BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
            else
                $query->where( "pedido.fecha_hora BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
        }

        if(!empty($this->fecha_entrega)) {
            list($fechaInicio,$fechaFin)= explode('-',$this->fecha_entrega);
            $queryParams[':fecha_inicio'] = trim($fechaInicio);
            $queryParams[':fecha_fin']    = trim($fechaFin);
            if (!empty($this->fecha_hora)) {
                if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                    $query->andWwhere( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
                else
                    $query->andWhere( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
            }
            else {
                if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                    $query->where( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
                else
                    $query->where( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
            }
        }
        
        if(!empty($this->razon_social)) {
            $query->andFilterWhere(['like', 'cliente.razon_social', $this->razon_social]);
        }
        if(!empty($this->id)) {
            $query->andFilterWhere(['pedido.id' => $this->id]);
        }
        
       // $query->orderBy(['fecha_hora' => SORT_DESC]);
        $query->orderBy(['orden_reparto' => SORT_ASC]);
        $query->andFilterWhere(['<>', 'estado', Pedido::ESTADO_PROCESANDO]);
        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchSinComandas($params)
    {
        $query = Pedido::find()->join('INNER JOIN','cliente', 'cliente.id = pedido.cliente_id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pedido.id' => $this->id,
            'fecha_hora' => $this->fecha_hora,
            'fecha_entrega' => $this->fecha_entrega,
            'fecha_produccion' => $this->fecha_produccion,
            'web_id' => $this->web_id,
            'comanda_id' => $this->comanda_id,
        //    'precio_total' => $this->precio_total,
        ]);

        $query->andFilterWhere(['like', 'ship_company', $this->ship_company])
            ->andFilterWhere(['like', 'ship_address_1', $this->ship_address_1])
            ->andFilterWhere(['like', 'ship_address_2', $this->ship_address_2])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_state', $this->ship_state])
            ->andFilterWhere(['like', 'ship_postcode', $this->ship_postcode])
            ->andFilterWhere(['like', 'ship_country', $this->ship_country])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'precio_total', $this->precio_total]);


        if(!empty($this->fecha_hora)) {
            list($fechaInicio,$fechaFin)= explode('-',$this->fecha_hora);
            $queryParams[':fecha_inicio'] = trim($fechaInicio);
            $queryParams[':fecha_fin']    = trim($fechaFin);
            if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                $query->where( "pedido.fecha_hora BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
            else
                $query->where( "pedido.fecha_hora BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
        }

        if(!empty($this->fecha_entrega)) {
            list($fechaInicio,$fechaFin)= explode('-',$this->fecha_entrega);
            $queryParams[':fecha_inicio'] = trim($fechaInicio);
            $queryParams[':fecha_fin']    = trim($fechaFin);
            if (!empty($this->fecha_hora)) {
                if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                    $query->andWwhere( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
                else
                    $query->andWhere( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
            }
            else {
                if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                    $query->where( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
                else
                    $query->where( "pedido.fecha_entrega BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
            }
        }

        if(!empty($this->razon_social)) {
            $query->andFilterWhere(['like', 'cliente.razon_social', $this->razon_social]);
        }
        if(!empty($this->id)) {
            $query->andFilterWhere(['pedido.id' => $this->id]);
        }


        $query->andFilterwhere(['comanda_id' => null]);
        $query->andFilterWhere(['<>', 'estado', Pedido::ESTADO_CANCELADO]);
        $query->andFilterWhere(['<>', 'estado', Pedido::ESTADO_COMPLETADO]);

        $query->orderBy(['orden_reparto' => SORT_ASC]);

        return $dataProvider;
    }

    public function searchPedidosComanda($comandaid)
    {
        $query = Pedido::find()->where(['comanda_id' =>$comandaid]);

      // add conditions that should always apply here

        $query->orderBy(['orden_reparto' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }


}
