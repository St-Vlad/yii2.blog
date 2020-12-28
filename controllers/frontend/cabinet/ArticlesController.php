<?php

namespace app\controllers\frontend\cabinet;

use app\blog\forms\frontend\cabinet\ArticleCreate;
use app\blog\forms\frontend\cabinet\ArticleUpdate;
use app\blog\repositories\readRepos\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use app\blog\services\ArticleService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ArticlesController extends \yii\web\Controller
{
    public $layout = '@app/views/frontend/layouts/main.php';

    private ArticleRepository $articleRepository;
    private CategoryRepository $categoryRepository;
    private ArticleService $service;

    public function __construct(
        $id,
        $module,
        ArticleRepository $articleRepository,
        ArticleService $service,
        CategoryRepository $categoryRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $categoriesList = $this->categoryRepository->findAll();
        $model = new ArticleCreate();
        try {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $this->service->create($model);
                return $this->redirect(['/cabinet']);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError', $e->getMessage());
        }
        return $this->render('articleCreate', [
            'categoriesList' => $categoriesList,
            'model' => $model,
        ]);
    }

    public function actionUpdate($slug)
    {
        $categoriesList = $this->categoryRepository->findAll();

        $article = $this->articleRepository->findBySlug($slug);
        $model = new ArticleUpdate($article);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->service->edit($article->id, $model);
                return $this->redirect(['/cabinet']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('viewError', $e->getMessage());
            }
        }

        return $this->render('articleUpdate', [
            'categoriesList' => $categoriesList,
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError', $e->getMessage());
        }
        return $this->redirect(['/cabinet']);
    }

    public function getViewPath()
    {
        return "@app/views/frontend/cabinet/forms";
    }
}
