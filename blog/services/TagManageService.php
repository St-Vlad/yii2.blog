<?php

namespace app\blog\services;

use app\blog\forms\backend\update\TagUpdate;
use app\blog\repositories\TagRepository;

class TagManageService
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit($id, TagUpdate $form): void
    {
        $tag = $this->repository->find($id);
        $tag->edit(
            $form->tag_name
        );
        $this->repository->save($tag);
    }

    public function remove($id): void
    {
        $tag = $this->repository->find($id);
        $this->repository->remove($tag);
    }
}
