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
        $query = Comanda::find();

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
        ]);

        if(!empty($this->fecha_produccion)) {
            list($fechaInicio,$fechaFin)= explode('-',$this->fecha_produccion);
            $queryParams[':fecha_inicio'] = trim($fechaInicio);
            $queryParams[':fecha_fin']    = trim($fechaFin);
            if ($queryParams[':fecha_fin'] == $queryParams[':fecha_inicio'] )
                $query->where( "fecha_produccion BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']." 00,00,00','%d/%m/%Y %k,%i,%s') AND STR_TO_DATE('".$queryParams[':fecha_fin']." 23,59,00','%d/%m/%Y %k,%i,%s')");
            else
                $query->where( "fecha_produccion BETWEEN STR_TO_DATE('".$queryParams[':fecha_inicio']."','%d/%m/%Y') AND STR_TO_DATE('".$queryParams[':fecha_fin']."','%d/%m/%Y')");
        }

        $query->andFilterWhere(['like', 'nota', $this->nota]);
        $query->orderBy(['fecha_produccion' => SORT_DESC]);

        return $dataProvider;
    }

}
