<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use app\blog\entities\Tag;

class TagRepository
{
    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    public function findBySlug($slug): ?Tag
    {
        return Tag::findOne(['slug' => $slug]);
    }

    public function findAllByArticle(Article $article): array
    {
        return Tag::find()
            ->joinWith('article')
            ->where(['article_id' => $article->id])->select('name')->asArray()->column();
    }
}
