<?php

namespace app\blog\repositories;

use app\blog\entities\Article;

class ArticleRepository
{
    public function get($id): Article
    {
        if (!$article = Article::findOne($id)) {
            throw new NotFoundException('Page is not found.');
        }
        return $article;
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
