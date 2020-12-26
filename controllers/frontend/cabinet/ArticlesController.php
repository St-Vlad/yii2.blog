<?php

namespace app\controllers\frontend\cabinet;

use app\blog\forms\frontend\cabinet\ArticleCreate;
use app\blog\repositories\ArticleRepository;
use app\blog\services\ArticleService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ArticlesController extends \yii\web\Controller
{
    public $layout = '@app/views/frontend/layouts/main.php';

    private ArticleRepository $repository;
    private ArticleService $service;

    public function __construct(
        $id,
        $module,
        ArticleRepository $repository,
        ArticleService $service,
        $config = []
    ) {
        $this->repository = $repository;
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        try {
            $model = $this->repository->find($id);
        } catch (NotFoundHttpException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError', $e->getMessage());
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new ArticleCreate();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->service->create($model);
            return $this->goBack();
        }

        return $this->render('articleCreate', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $category = $this->repository->find($id);
        $model = new CategoryUpdate($category);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->service->edit($category->id, $model);
                return $this->redirect(['admin/categories', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('viewError', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
            return $this->redirect(['admin/categories']);
        } catch (NotFoundHttpException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError', $e->getMessage());
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function getViewPath()
    {
        return "@app/views/frontend/cabinet/forms";
    }
}
