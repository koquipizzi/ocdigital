<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producto;
use app\models\ProductoRol;

/**
 * ProductoSearch represents the model behind the search form about `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'web_id'], 'integer'],
            [['nombre'], 'safe'],
            [['precio_unitario','codigo'], 'number'],
            [[ 'categoria_id'], 'string']

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
        $productosRol = ProductoRol::find()->all();
        $query = Producto::find()->join('INNER JOIN','categoria', 'categoria.id = producto.categoria_id');
        $pr = [];
        foreach ($productosRol as $productoRol) {
            if (!in_array($productoRol->producto_id, $pr) ) {
              if ($productoRol->rol_id  != Rol::HIDDENROLID) {
                $pr[] =  $productoRol->producto_id;
              }
            }
        }
        $productosRol = $pr;
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
            'precio_unitario' => $this->precio_unitario,
            'web_id' => $this->web_id,
        ]);

        $query->andFilterWhere(['like', self::tableName() .'.nombre', $this->nombre]);
        if(!empty($this->categoria_id)) {
            $query->andFilterWhere(['like', 'categoria.nombre', $this->categoria_id]);
        }

        $query->andFilterWhere(['in', 'producto.id', $productosRol]);
        $query->andFilterWhere(['like', 'codigo', $this->codigo]);

        return $dataProvider;
    }

    public function searchSinRoles($params)
    {

        $productosPendientes = ProductoRol::find()->all();
        $query = Producto::find();
        $pd = [];
        foreach ($productosPendientes as $productoPendiente) {
          if (!in_array($productoPendiente->producto_id, $pd) ) {
            if ($productoPendiente->rol_id  != Rol::HIDDENROLID) {
              $pd[] =  $productoPendiente->producto_id;
            }
          }
        }
        $productosPendientes = $pd;
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
            'id' => $this->id,
            'categoria_id' => $this->categoria_id,
            'precio_unitario' => $this->precio_unitario,
            'web_id' => $this->web_id,
            'codigo' => $this->codigo,
        ]);

        $query->andFilterWhere(['not',[ 'id' => $productosPendientes]]);
        // var_dump($dataProvider); die();
        return $dataProvider;
    }
}
