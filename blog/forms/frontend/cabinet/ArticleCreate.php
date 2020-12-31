<?php

namespace app\blog\forms\frontend\cabinet;

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
            [['tags'], 'each', 'rule' => ['string', 'max' => 50]]
        ];
    }

    /*public function beforeValidate()

    {
        if (parent::beforeValidate()) {
            if (!is_array($this->tags)) {
                return $this->tags = [];
            }
            return true;

        }
    }*/
}
