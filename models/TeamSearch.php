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

        $this->load($params, 'TeamSearch');

        $query->andFilterWhere(['name' => $this->name]);
        $query->andFilterWhere(['group_name' => $this->group_name]);
        $query->orderBy(['group_name' => SORT_ASC, 'name' => SORT_ASC]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);
    }
}
