<?php

namespace app\controllers\backend;

use app\blog\forms\backend\search\TagSearch;
use app\blog\forms\backend\update\TagUpdate;
use app\blog\repositories\TagRepository;
use app\blog\services\blog\TagService;
use Yii;
use yii\db\IntegrityException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TagsController extends Controller
{
    public $layout = '@app/views/backend/layouts/main.php';

    private TagRepository $repository;
    private TagService $service;

    public function __construct(
        $id,
        $module,
        TagRepository $repository,
        TagService $service,
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
        $searchModel = new TagSearch();
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
     * Updates an existing Categorie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $tag = $this->repository->find($id);
        $model = new TagUpdate($tag);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->service->edit($tag->id, $model);
                return $this->redirect(['admin/tags', 'id' => $tag->id]);
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
            return $this->redirect(['admin/tags']);
        } catch (IntegrityException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function getViewPath()
    {
        return "@app/views/backend/tag";
    }
}
