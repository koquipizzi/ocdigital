<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Workflow;
use yii\db\Expression;

/**
 * WorkflowSearch represents the model behind the search form of `app\models\Workflow`.
 */
class WorkflowSearch extends Workflow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estado_id', 'user_id', 'pedido_id'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Workflow::find();

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
            'id' => $this->id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estado_id' => $this->estado_id,
            'user_id' => $this->user_id,
            'pedido_id' => $this->pedido_id,
        ]);

        return $dataProvider;
    }
    
    public function searchDetalleWorkflow($params,$pedido_id)
    {
        
        
        $queryParams = [];
        $where = "workflow.pedido_id={$pedido_id}";
        $GROUP_BY ='';
        $formParams = [];
        
        
        $fieldList = "
              workflow.id
             ,workflow.fecha_inicio as fecha_inicio
             ,workflow.fecha_fin    as fecha_fin
             ,user.username         as responsable
             ,estado.descripcion    as estado
        ";
        $fromTables = '
            workflow
            JOIN user    ON(workflow.user_id   = user.id)
            JOIN estado  ON(workflow.estado_id = estado.id)
        ';
        
        
        
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
          'defaultOrder' => ['workflow.fecha_inicio' => SORT_ASC],
          'attributes' => [
           'workflow.fecha_fin',
           'workflow.fecha_inicio',
           'estado.id',
           'user.username',
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
    
    
    
    
}
