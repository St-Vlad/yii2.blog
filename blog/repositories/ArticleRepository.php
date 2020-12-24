<?php

namespace app\blog\repositories;

use app\blog\entities\Article;

class ArticleRepository
{
    public function find($id): ?Article
    {
        return Article::findOne($id);
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

    public function remove($id): void
    {
        $article = $this->find($id);
        if (!$article->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
