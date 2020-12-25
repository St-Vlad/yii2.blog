<?php

namespace app\commands;

use app\blog\entities\Category;
use app\blog\repositories\CategoryRepository;
use Faker\Factory;
use yii\console\Controller;

class CategoryController extends Controller
{
    private CategoryRepository $repository;

    public function __construct($id, $module, CategoryRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        echo 'to create categorie, type \'./yii categorie/create {category_count}\'' . PHP_EOL;
        echo 'to remove categorie, type \'./yii categorie/remove {category_id}\'' . PHP_EOL;
    }

    public function actionCreate($count)
    {
        $faker = Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $category = Category::create(
                $faker->domainWord
            );
            $this->repository->save($category);
        }
        echo 'created successfully' . PHP_EOL;
    }

    public function actionRemove($id)
    {
        try {
            $this->repository->remove($id);
        } catch (\RuntimeException $exception) {
            echo $exception;
        }
        echo 'removed successfully' . PHP_EOL;
    }
}
