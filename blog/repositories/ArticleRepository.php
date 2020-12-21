<?php

namespace app\blog\repositories;

use app\modules\blog\models\Article;

class ArticleRepository
{
    public function find($id): ?Article
    {
        return Article::findOne($id);
    }

    public function findAll()
    {
        return Article::findAll(['status' => Article::STATUS_ACTIVE]);
    }

    public function save(Article $article): void
    {
        if (!$article->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}