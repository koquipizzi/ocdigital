<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ComandaDetalle;
use yii\data\SqlDataProvider;


/**
 * ComandaDetalleSearch represents the model behind the search form about `app\models\ComandaDetalle`.
 */
class ComandaDetalleSearch extends ComandaDetalle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cantidad_produccion', 'orden_reparto','comanda_id', 'producto_id'], 'integer'],
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
        $query = ComandaDetalle::find();

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
            'cantidad_produccion' => $this->cantidad_produccion,
            'comanda_id' => $this->comanda_id,
            'producto_id' => $this->producto_id,
        ]);

        $query->orderBy(['orden_reparto' => SORT_ASC]);

        return $dataProvider;
    }

    public function searchComandaId($id)
    {
        $query = ComandaDetalle::find()->select('sum(cantidad_produccion) as cantidad_produccion,producto_id ');
        $query->joinWith(['producto']);
        $query->groupBy('producto_id');
        $query->orderBy('categoria_id');
     //   $query->joinWith(['categoria']);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'comanda_id' => $id,
        ]);

        return $dataProvider;
    }

    public function searchGroupByCat($id)
    {
        $query = ComandaDetalle::find()->select('sum(cantidad_produccion) as cantidad_produccion,producto_id ');
        $query->joinWith(['producto']);
        $query->groupBy('producto_id');
        $query->orderBy('categoria_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([
            'comanda_id' => $id,
        ]);

        return $dataProvider;
    }

    public function searchGroupByProdCat($id, $cat)
    {
        $query = ComandaDetalle::find()->select('sum(cantidad_produccion) as cantidad_produccion, producto_id ')
            ->where(['producto.categoria_id' => $cat, 'comanda_id' => $id]);
        $query->joinWith(['producto']);
        $query->groupBy('producto_id');
        $query->orderBy('categoria_id');

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $provider;
    }

    public function searchGroupByProd($id)
    {
        $query = ComandaDetalle::find()->select('sum(cantidad_produccion) as cantidad_produccion,producto_id ');
        $query->joinWith(['producto']);
        $query->groupBy('producto_id');
        $query->orderBy('categoria_id');
        $query = 'SELECT producto_id, PROD.nombre as nombre_prod, sum(cantidad_produccion) as cantidad_produccion
            FROM comandas.comanda_detalle 
            join comandas.producto as PROD
            on comanda_detalle.producto_id = PROD.id
            where comanda_id ='.$id.' group by producto_id ';

        $queryCount = 'SELECT count(producto_id) FROM comandas.comanda_detalle where comanda_id ='.$id.' group by producto_id ';

        $count = Yii::$app->db->createCommand($queryCount)->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => $query,
            'totalCount' => $count,
            'pagination' => [
               'pageSize' => 10,
            ]
        ]);

      return $provider;
    }
}

