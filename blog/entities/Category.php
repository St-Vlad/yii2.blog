<?php

namespace app\blog\entities;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $id
 * @property string $category_name
 * @property string $slug
 */
class Category extends ActiveRecord
{
    public static function create($name): self
    {
        $category = new static();
        $category->category_name = $name;
        return $category;
    }

    public function edit($name): void
    {
        $this->category_name = $name;
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'category_name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    public static function tableName(): string
    {
        return '{{%categories}}';
    }

    public function getArticles(): ActiveQuery
    {
        return $this->hasMany(Article::class, ['category_id' => 'id']);
    }
}
