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

    public function rules()
    {
        return [
            [['id', 'category_id', 'status'], 'integer'],
            [['title', 'description', 'preview'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Article::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
