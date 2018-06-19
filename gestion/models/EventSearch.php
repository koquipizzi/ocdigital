<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;

/**
 * EventSearch represents the model behind the search form of `app\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pedido_id'], 'integer'],
            [['title', 'allDay', 'start', 'end', 'entrega', 'url', 'className', 'editable', 'startEditable', 'durationEditable', 'source', 'color', 'backgroundColor', 'borderColor', 'textColor'], 'safe'],
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
        $query = Event::find();

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
            'start' => $this->start,
            'end' => $this->end,
            'entrega' => $this->entrega,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'allDay', $this->allDay])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'className', $this->className])
            ->andFilterWhere(['like', 'editable', $this->editable])
            ->andFilterWhere(['like', 'startEditable', $this->startEditable])
            ->andFilterWhere(['like', 'durationEditable', $this->durationEditable])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'backgroundColor', $this->backgroundColor])
            ->andFilterWhere(['like', 'borderColor', $this->borderColor])
            ->andFilterWhere(['like', 'textColor', $this->textColor]);

        return $dataProvider;
    }
}
