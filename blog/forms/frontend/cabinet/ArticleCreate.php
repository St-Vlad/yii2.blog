<?php

namespace app\blog\forms\frontend\cabinet;

use app\blog\entities\Article;
use app\blog\entities\Category;
use yii\base\Model;

class ArticleCreate extends Model
{
    public ?int $category_id = 0;
    public ?string $title = '';
    public ?string $preview = '';
    public ?string $description = '';
    public ?string $text = '';
    public $tags;

    public function rules(): array
    {
        return [
            [['category_id'], 'integer'],
            [['title', 'description', 'text', 'preview'], 'required'],
            [['title'], 'string', 'max' => 50],
            ['title', 'unique', 'targetClass' => Article::class, 'message' => 'This title is already exist'],
            [['description'], 'string', 'max' => 250],
            [['text'], 'string', 'max' => 1500],
            [['preview'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::class,
                'targetAttribute' => ['category_id' => 'id']
            ],
            [['tags'], 'each', 'rule' => ['string', 'max' => 50]],
            [['tags'], 'each', 'rule' => ['match', 'pattern' => '#^[А-Яа-я\w]+$#u']]
        ];
    }
}
