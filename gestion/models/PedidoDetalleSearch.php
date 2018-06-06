<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PedidoDetalle;

/**
 * PedidoDetalleSearch represents the model behind the search form about `app\models\PedidoDetalle`.
 */
class PedidoDetalleSearch extends PedidoDetalle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pedido_id', 'producto_id', 'cantidad'], 'integer'],
            [['precio_linea'], 'safe'],
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
        $query = PedidoDetalle::find();

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
            'pedido_id' => $this->pedido_id,
            'producto_id' => $this->producto_id,
            'cantidad' => $this->cantidad,
        ]);

        $query->andFilterWhere(['like', 'precio_linea', $this->precio_linea]);

        return $dataProvider;
    }

    public function searchDetalle($id)
    {
        $query = PedidoDetalle::find([]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'pedido_id' => $id,
        ]);

        return $dataProvider;
    }



}
