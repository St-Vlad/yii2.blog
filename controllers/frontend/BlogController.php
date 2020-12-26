<?php

namespace app\controllers\frontend;

use app\blog\repositories\readRepos\ArticleRepository;
use yii\web\Controller;

class BlogController extends Controller
{
    private ArticleRepository $repository;

    public $layout = '@app/views/frontend/layouts/main.php';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function __construct(
        $id,
        $module,
        ArticleRepository $repository,
        $config = []
    ) {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $dataProvider = $this->repository->getAllActive();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategory($category)
    {
        $dataProvider = $this->repository->getAllByCategory($category);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArticle($title)
    {
        $model = $this->repository->getByTitle($title);
        return $this->render('detailView', [
            'model' => $model,
        ]);
    }

    public function getViewPath()
    {
        return '@app/views/frontend';
    }
}
