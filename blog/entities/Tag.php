<?php

namespace app\blog\entities;

use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $tag_name
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
                'attribute' => 'tag_name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    public static function create(
        $name
    ): Tag {
        $tag = new Tag();
        $tag->tag_name = $name;
        return $tag;
    }

    public function edit($name): void
    {
        $this->tag_name = $name;
    }

    public function getArticle(): ActiveQuery
    {
        return $this->hasMany(Article::class, ['id' => 'article_id'])
            ->viaTable('articles_tags', ['tag_id' => 'id']);
    }
}
