<?php

namespace app\blog\forms\frontend\cabinet;

use app\blog\entities\Category;
use yii\base\Model;

class ArticleCreate extends Model
{
    public ?string $category_id = '';
    public ?string $title = '';
    public ?string $preview = '';
    public ?string $description = '';
    public ?string $text = '';

    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title', 'description', 'text', 'preview'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['text'], 'string', 'max' => 1500],
            [['preview'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }
}
