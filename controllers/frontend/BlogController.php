<?php

namespace app\controllers\frontend;

use app\blog\repositories\readRepos\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BlogController extends Controller
{
    private ArticleRepository $articleRepository;
    private CategoryRepository $categoryRepository;

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
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        $config = []
    ) {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $dataProvider = $this->articleRepository->findAllActive();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategory($slug)
    {
        if (!$category = $this->categoryRepository->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->articleRepository->findAllByCategory($category);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArticle($slug)
    {
        if (!$model = $this->articleRepository->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('detailView', [
            'model' => $model,
        ]);
    }

    public function getViewPath()
    {
        return '@app/views/frontend';
    }
}
