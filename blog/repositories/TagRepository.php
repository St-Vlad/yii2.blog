<?php

namespace app\blog\repositories;

use app\blog\entities\Article;
use app\blog\entities\Tag;

class TagRepository
{
    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Page is not found.');
        }
        return $tag;
    }

    public function findAllByArticle(Article $article): array
    {
        return Tag::find()->innerjoinWith('article')->where(['article_id' => $article->id])->all();
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }
}
