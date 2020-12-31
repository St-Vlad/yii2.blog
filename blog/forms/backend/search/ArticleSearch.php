<?php

namespace app\blog\forms\backend\search;

use app\blog\entities\Article;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArticleSearch extends Model
{
    public $id;
    public $category_name;
    public $tag_name;
    public $title;
    public $preview;
    public $description;
    public $status;

    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'category_name', 'tag_name', 'title', 'description'], 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Article::find()->joinWith(['category', 'tag'], true, 'JOIN');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['id', 'category_name', 'title', 'description', 'status', 'tag_name']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'category_name', $this->category_name])
            ->andFilterWhere(['like', 'tag_name', $this->tag_name]);

        return $dataProvider;
    }
}
