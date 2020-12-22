<?php

namespace app\controllers\frontend;

use app\blog\repositories\readRepos\ArticleRepository;
use yii\web\Controller;

class MainController extends Controller
{
    private ArticleRepository $repository;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function __construct($id, $module, ArticleRepository $repository, $config = [])
    {
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

    public function getViewPath()
    {
        return '@app/views/frontend';
    }
}
