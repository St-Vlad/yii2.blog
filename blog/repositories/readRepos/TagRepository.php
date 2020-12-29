<?php

namespace app\blog\repositories\readRepos;

use app\blog\entities\Tag;

class TagRepository
{
    public function findBySlug($slug): ?Tag
    {
        return Tag::findOne(['slug' => $slug]);
    }
}