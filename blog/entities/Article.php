<?php

namespace app\blog\entities;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $category_id
 * @property string $title
 * @property string $slug
 * @property string $preview
 * @property string $description
 * @property string $text
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $categorie
 * @property User $user
 */
class Article extends ActiveRecord
{
    public const STATUS_MODERATION = 0;
    public const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%articles}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('CURRENT_TIMESTAMP()'),
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    public static function create(
        $user_id,
        $category_id,
        $title,
        $preview,
        $description,
        $text,
        $status = Article::STATUS_MODERATION
    ): Article {
        $article = new Article();
        $article->user_id = $user_id;
        $article->category_id = $category_id;
        $article->title = $title;
        $article->preview = $preview;
        $article->description = $description;
        $article->text = $text;
        $article->status = $status;
        return $article;
    }

    public function edit($category_id, $title, $preview, $description, $text): void
    {
        $this->category_id = $category_id;
        $this->title = $title;
        $this->preview = $preview;
        $this->description = $description;
        $this->text = $text;
    }

    public function swapStatus(Article $article)
    {
        if ($article->status === self::STATUS_ACTIVE) {
            $this->status = self::STATUS_MODERATION;
        } else {
            $this->status = self::STATUS_ACTIVE;
        }
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getTag(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('articles_tags', ['article_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    /**
     * @return string[]
     */
    public static function getStatusesArray(): array
    {
        return [
            self::STATUS_MODERATION => 'On Moderation',
            self::STATUS_ACTIVE => 'Published',
        ];
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
