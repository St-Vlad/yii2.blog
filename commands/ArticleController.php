<?php

namespace app\commands;

use app\blog\entities\Article;
use app\blog\repositories\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use app\blog\repositories\readRepos\UserRepository;
use app\blog\services\ArticleService;
use Faker\Factory;
use Yii;
use yii\console\Controller;

class ArticleController extends Controller
{
    private ArticleService $service;
    private ArticleRepository $articleRepo;
    private CategoryRepository $categoryRepo;
    private UserRepository $userRepo;

    private string $imageThumbUrl = 'https://picsum.photos/150';

    public function __construct(
        $id,
        $module,
        ArticleService $service,
        ArticleRepository $articleRepo,
        CategoryRepository $categoriesRepo,
        UserRepository $usersRepo,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->articleRepo = $articleRepo;
        $this->categoryRepo = $categoriesRepo;
        $this->userRepo = $usersRepo;
    }

    public function actionIndex()
    {
        echo 'to create article, type \'./yii article/create {article_count}\'' . PHP_EOL;
        echo 'to remove article, type \'./yii article/remove {article_id}\'' . PHP_EOL;
    }

    public function actionCreate($count)
    {
        $faker = Factory::create();

        $usersIds = $this->userRepo->findAllUserIds();
        if (!$categoriesIds = $this->categoryRepo->findAllCategoriesIds()) {
            throw new \DomainException('at least one category must exist');
        }

        for ($i = 0; $i < $count; $i++) {
            $article = Article::create(
                $this->getRandomValue($usersIds),
                $this->getRandomValue($categoriesIds),
                $faker->text($maxNbChars = 50),
                $this->imageThumbUrl,
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
