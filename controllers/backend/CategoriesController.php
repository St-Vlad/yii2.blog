<?php

namespace app\controllers\backend;

use app\blog\forms\backend\search\CategorySearch;
use app\blog\forms\backend\create\CategoryCreate;
use app\blog\forms\backend\update\CategoryUpdate;
use app\blog\repositories\CategoryRepository;
use app\blog\services\blog\CategoryService;
use Yii;
use yii\db\IntegrityException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriesController implements the CRUD actions for Categorie model.
 */
class CategoriesController extends Controller
{
    public $layout = '@app/views/backend/layouts/main.php';

    private CategoryRepository $repository;
    private CategoryService $service;

    public function __construct(
        $id,
        $module,
        CategoryRepository $repository,
        CategoryService $service,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
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

    /**
     * Lists all Categorie models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categorie model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->repository->find($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Categorie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryCreate();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->service->create($model);
            return $this->redirect(['admin/categories']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categorie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $category = $this->repository->find($id);
        $model = new CategoryUpdate($category);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->service->edit($category->id, $model);
                return $this->redirect(['admin/categories', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('viewError');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categorie model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        try {
            $this->service->remove($id);
            return $this->redirect(['admin/categories']);
        } catch (IntegrityException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function getViewPath()
    {
        return "@app/views/backend/category";
    }
}
