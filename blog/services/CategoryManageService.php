<?php

namespace app\blog\services;

use app\blog\entities\Category;
use app\blog\forms\backend\create\CategoryCreate;
use app\blog\forms\backend\update\CategoryUpdate;
use app\blog\repositories\CategoryRepository;

class CategoryManageService
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(CategoryCreate $form): void
    {
        $category = Category::create($form->name);
        $this->repository->save($category);
    }

    public function edit($id, CategoryUpdate $form): void
    {
        $category = $this->repository->find($id);
        $category->edit(
            $form->name
        );
        $this->repository->save($category);
    }

    public function remove($id): void
    {
        $category = $this->repository->find($id);
        $this->repository->remove($category);
    }
}
