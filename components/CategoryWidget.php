<?php

namespace app\components;

use app\blog\repositories\readRepos\CategoryRepository;
use yii\base\Widget;

class CategoryWidget extends Widget
{
    private $repository;

    public function __construct(CategoryRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($config);
    }

    public function run()
    {
        $categories =  $this->repository->getAll();
        return $this->render('categoryBar', ['categories' => $categories]);
    }
}
