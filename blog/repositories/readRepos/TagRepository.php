<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Article;
use app\blog\entities\Tag;

class TagRepository
{
    public function findByName($tag_name): ?Tag
    {
        return Tag::findOne(['tag_name' => $tag_name]);
    }

    public function findAllByArticle(Article $article): array
    {
        return Tag::find()
            ->joinWith('article')
            ->where(['article_id' => $article->id])->select('tag_name')->asArray()->column();
    }
}
