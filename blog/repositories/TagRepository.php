<?php

namespace app\blog\repositories;

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

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove($tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
