<?php

namespace app\blog\entities;

use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $name
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
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    public static function create(
        $name
    ): Tag {
        $tag = new Tag();
        $tag->name = $name;
        return $tag;
    }

    public function getArticle(): ActiveQuery
    {
        return $this->hasMany(Article::class, ['id' => 'article_id'])
            ->viaTable('articles_tags', ['tag_id' => 'id']);
    }
}
