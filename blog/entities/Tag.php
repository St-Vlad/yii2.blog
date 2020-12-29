<?php

namespace app\blog\entities;

use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property int|null $article_id
 * @property string $title
 * @property string $slug
 *
 * @property Article $article
 */
class Tag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%tags}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    public static function create(
        $article_id,
        $title,
        $slug
    ): Tag {
        $tag = new Tag();
        $tag->article_id = $article_id;
        $tag->title = $title;
        $tag->slug = $slug;
        return $tag;
    }

    public function getArticles(): ActiveQuery
    {
        return $this->hasMany(Article::class, ['article_id' => 'id']);
    }
}
