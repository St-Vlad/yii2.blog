<?php

namespace app\widgets;

use app\blog\repositories\readRepos\CategoryRepository;
use yii\base\Widget;

class CategoryWidget extends Widget
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($config);
    }

    public function run()
    {
        $categories =  $this->repository->findAll();
        return $this->render('categoryBar', ['categories' => $categories]);
    }
}
