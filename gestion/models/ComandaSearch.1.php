<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comanda;

/**
 * ComandaSearch represents the model behind the search form about `app\models\Comanda`.
 */
class ComandaSearch extends Comanda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fecha_produccion', 'nota'], 'safe'],
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
       // $query = Comanda::find();
        $query1 = "select * from comanda";
        if(isset($params['ComandaSearch']['fecha_produccion']))
        {
            list($start_date, $end_date) = explode(' - ', $params['ComandaSearch']['fecha_produccion']); 

            $dia = substr($start_date,0,2);
            $mes = substr($start_date,3,2);
            $anio = substr($start_date,6,4);
            $time = $anio."-".$mes."-".$dia;
            $dia2 = substr($end_date,0,2);
            $mes2 = substr($end_date,3,2);
            $anio2 = substr($end_date,6,4);
            $time2 = $anio2."-".$mes2."-".$dia2;
            $query1 = $query1." where comanda.fecha_produccion between '".$time."' and '".$time2."'";

        }
   //     var_dump($time);  var_dump($time2); 
   //     die();

    //    $query = $query1." where comanda.fecha_produccion between '".$time."' and '".$time2."'";

        $queryCount = "select count(tt.id) as total from comanda as tt";

        if(isset($time))
            {
                $queryCount = $queryCount." where tt.fecha_produccion between '".$time."' and '".$time2."'";
            }

      //  $consultaCant = "select count(tt.id) as total from ( ".$consulta." ) as tt";
        $command =  \Yii::$app->db->createCommand($queryCount);
        $results = $command->queryAll();
        $itemsCount = (int)$results[0]["total"];    

        $dataProvider = new \yii\data\SqlDataProvider([
            'sql' => $query1,
       //     'sort'=> ['defaultOrder' => ['fecha_produccion'=> SORT_DESC]], 
            'totalCount' => $itemsCount,
            'pagination' => [
                    'pageSize' => 50,
            ],
        ]);

     //   if (!($this->load($params) && $this->validate())) {
       //     return $dataProvider;
      //  }
        
      
      $models = $dataProvider->getModels();
      return $dataProvider;



    }



}
