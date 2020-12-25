<?php

namespace app\blog\entities;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $id
 * @property string $name
 */
class Category extends ActiveRecord
{
    public static function create($name): self
    {
        $category = new static();
        $category->name = $name;
        return $category;
    }

    public function edit($name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function tableName()
    {
        return 'categories';
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }
}
