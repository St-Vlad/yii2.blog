<?php

namespace app\blog\repositories;

use app\blog\entities\Article;
use yii\web\NotFoundHttpException;

class ArticleRepository
{
    public function find($id): ?Article
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function findAll(): array
    {
        return Article::findAll(['status' => Article::STATUS_ACTIVE]);
    }

    public function save(Article $article): void
    {
        if (!$article->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove($article): void
    {
        if (!$article->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
