<?php

namespace app\blog\entities;

use app\blog\entities\User;
use app\blog\repositories\readRepos\ArticleRepository;
use Yii;
use yii\behaviors\TimestampBehavior;
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
    const STATUS_MODERATION = 0;
    const STATUS_ACTIVE = 1;

    public static function create($user_id, $category_id, $title, $description, $text): Article
    {
        $article = new Article();
        $article->user_id = $user_id;
        $article->category_id = $category_id;
        $article->title = $title;
        $article->description = $description;
        $article->text = $text;
        $article->status = Article::STATUS_MODERATION;
        return $article;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    /*public function rules()
    {
        return [
            [['user_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'text', 'created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 100],
            [['text'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }*/

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('CURRENT_TIMESTAMP()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'description' => 'Description',
            'text' => 'Text',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_MODERATION => 'На модерації',
            self::STATUS_ACTIVE => 'Активний',
        ];
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isOnModeration(): bool
    {
        return $this->status === self::STATUS_MODERATION;
    }
}
