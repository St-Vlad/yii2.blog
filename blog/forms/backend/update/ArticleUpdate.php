<?php

namespace app\blog\forms\backend\update;

use app\blog\entities\Article;
use app\blog\entities\Category;

class ArticleUpdate extends \yii\base\Model
{
    public ?int $category_id;
    public ?string $title = '';
    public ?string $preview = '';
    public ?string $description = '';
    public ?string $text = '';
    public ?int $status;

    public function __construct(Article $article, $config = [])
    {
        parent::__construct($config);
        $this->category_id = $article->category_id;
        $this->title = $article->title;
        $this->preview = $article->preview;
        $this->description = $article->description;
        $this->text = $article->text;
        $this->status = $article->status;
    }

    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title', 'description', 'text', 'preview'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['text'], 'string', 'max' => 1500],
            [['preview'], 'string', 'max' => 255],
            [['status'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }
}