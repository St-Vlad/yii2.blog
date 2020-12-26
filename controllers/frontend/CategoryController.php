<?php

namespace app\controllers\frontend;

use app\blog\repositories\readRepos\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use yii\web\Controller;

class CategoryController extends Controller
{
    public $layout = '@app/views/frontend/layouts/main.php';

    private $repository;

    public function __construct($id, $module, ArticleRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($category)
    {
        $dataProvider = $this->repository->getAllByCategory($category);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function getViewPath()
    {
        return "@app/views/frontend";
    }
}
