<?php

namespace app\blog\repositories;

use app\blog\entities\Category;
use yii\web\NotFoundHttpException;

class CategoryRepository
{
    public function get($id): ?Category
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    public function remove($id): void
    {
        $category = $this->get($id);
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
