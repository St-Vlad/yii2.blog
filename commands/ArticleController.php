<?php

namespace app\commands;

use app\blog\entities\Article;
use app\blog\repositories\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use app\blog\repositories\readRepos\UserRepository;
use Faker\Factory;
use yii\console\Controller;

class ArticleController extends Controller
{
    private ArticleRepository $articleRepo;
    private CategoryRepository $categoryRepo;
    private UserRepository $userRepo;

    public function __construct(
        $id,
        $module,
        ArticleRepository $articleRepo,
        CategoryRepository $categoriesRepo,
        UserRepository $usersRepo,
        $config = []
    ) {
        $this->articleRepo = $articleRepo;
        $this->categoryRepo = $categoriesRepo;
        $this->userRepo = $usersRepo;
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

        $usersIds = $this->userRepo->getAllUserIds();
        $categoriesIds = $this->categoryRepo->getAllCategoriesIds();

        for ($i = 0; $i < $count; $i++) {
            $article = Article::create(
                $this->getRandomValue($usersIds),
                $this->getRandomValue($categoriesIds),
                $faker->text($maxNbChars = 50),
                $faker->text($maxNbChars = 250),
                $faker->text($maxNbChars = 1500),
                $status = Article::STATUS_ACTIVE
            );
            $this->articleRepo->save($article);
        }

        echo 'created successfully' . PHP_EOL;
    }

    public function actionRemove($id)
    {
        try {
            $this->articleRepo->remove($id);
        } catch (\RuntimeException $exception) {
            echo $exception->getCode();
        }
        echo 'removed successfully' . PHP_EOL;
    }

    private function getRandomValue($array): int
    {
        $key = array_rand($array);
        return intval($array[$key]);
    }
}
