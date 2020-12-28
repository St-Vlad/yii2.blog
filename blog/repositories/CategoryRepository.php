<?php

namespace app\blog\repositories;

use app\blog\entities\Category;
use yii\web\NotFoundHttpException;

class CategoryRepository
{
    public function find($id): ?Category
    {
        return Category::findOne($id);
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    public function remove($id): void
    {
        $category = $this->find($id);
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
