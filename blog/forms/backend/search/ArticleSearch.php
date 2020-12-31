<?php

namespace app\blog\forms\backend\search;

use app\blog\entities\Article;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArticleSearch extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $preview;
    public $description;
    public $status;
    public $name;

    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'category_id', 'title', 'description'], 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Article::find()->innerJoinWith('tag', true);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['id', 'category_id', 'title', 'description', 'status', 'name']]
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['category.name' => SORT_ASC],
            'desc' => ['category.name' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'category_id' => $this->category_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name]);

        //$query->andFilterWhere(['like', 'category.name', $this->category]);

        return $dataProvider;
    }
}
