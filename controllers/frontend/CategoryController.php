<?php

namespace app\controllers\frontend;

use app\blog\repositories\readRepos\ArticleRepository;

class CategoryController extends \yii\web\Controller
{
    private $repository;

    public function __construct($id, $module, ArticleRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($id)
    {
        $dataProvider = $this->repository->getAllByCategory($id);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
