<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'web_customer_id'], 'integer'],
            [['razon_social', 'usuario_web', 'password_web','email','nombre','apellido'], 'safe'],
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
        $query = Cliente::find();

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
            'web_customer_id' => $this->web_customer_id,
        ]);

        $query->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'usuario_web', $this->usuario_web])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido]);

        return $dataProvider;
    }

    public function searchProductos($modelCliente)
    {
      $query = Producto::find();
      $clienteRol = ClienteRol::find()->where(['cliente_id' => $modelCliente->id])->andWhere(['<>','rol_id', Rol::DEFAULTROLID])->one();
      if (!empty($clienteRol)) {
        $rol = Rol::find()->where(['id' => $clienteRol->rol_id])->one();
        if (!empty($rol)) {
          $productosClientes = ProductoRol::find()->where(['rol_id' => $rol->id])->all();
          if (!empty($productosClientes)){
            $pd = [];
            foreach ($productosClientes as $productoClientes) {
              $pd[] =  $productoClientes->producto_id;
            }
            $productosClientes = $pd;
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $query->andFilterWhere(['in', 'id' , $productosClientes]);
            return $dataProvider;
          }
        }
      }
      $dataProvider = new ActiveDataProvider([
          'query' => $query,
      ]);
      $query->andFilterWhere(['id' => 0]); //absurdo
      return $dataProvider;

    }
}
