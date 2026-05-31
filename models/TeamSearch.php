<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class TeamSearch extends Team
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'full_name', 'group_name'], 'string'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Team::find();

        $this->load($params, '');
        if (!$this->validate()) {
            $query->orderBy(['group_name' => SORT_ASC, 'name' => SORT_ASC]);
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => ['pageSize' => 50],
            ]);
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'full_name', $this->full_name]);
        $query->andFilterWhere(['like', 'group_name', $this->group_name]);
        $query->orderBy(['group_name' => SORT_ASC, 'name' => SORT_ASC]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);
    }
}
