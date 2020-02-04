<?php

namespace app\models\search;


use app\models\base\Posts;
use yii\data\ActiveDataProvider;

class PostSearch extends Posts
{
    public function rules()
    {
        return [
            ['title', 'string'],
            ['is_visible', 'boolean'],
        ];
    }

    public function search(array $params)
    {
        $query = self::find();

        $query->orderBy([
            'created_at' => SORT_DESC
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => \Yii::$app->params['paginatorPageSize'],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if (!empty($this->title)) {
            foreach (explode(' ', $this->title) as $part) {
                $query->andFilterWhere([
                    'like',
                    'lower(title)',
                    mb_strtolower($part),
                ]);
            }
        }

        if ($this->is_visible !== '') {
            $query->andFilterWhere(['is_visible' => (int)$this->is_visible]);
        }

        return $dataProvider;
    }
}