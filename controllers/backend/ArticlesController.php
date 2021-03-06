<?php

namespace app\controllers\backend;

use app\blog\forms\backend\search\ArticleSearch;
use app\blog\forms\common\ArticleUpdate;
use app\blog\repositories\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use app\blog\repositories\readRepos\TagRepository;
use app\blog\services\blog\ArticleService;
use DomainException;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticlesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends Controller
{
    public $layout = '@app/views/backend/layouts/main.php';

    private ArticleRepository $articleRepository;
    private CategoryRepository $categoryRepository;
    private ArticleService $service;
    private TagRepository $tagRepository;

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

    public function __construct(
        $id,
        $module,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        ArticleService $service,
        TagRepository $tagRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->service = $service;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
    {
        $model = $this->articleRepository->get($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $categoriesList = $this->categoryRepository->findAll();
        $article = $this->articleRepository->get($id);
        $tagsList = $this->tagRepository->findAllByArticle($article);
        $updateForm = new ArticleUpdate($article, $tagsList);
        if ($updateForm->load(Yii::$app->request->post()) && $updateForm->validate()) {
            try {
                $this->service->edit($article->id, $updateForm);
                return $this->redirect(['admin/articles']);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('viewError');
            }
        }

        return $this->render('update', [
            'updateForm' => $updateForm,
            'categoriesList' => $categoriesList,
        ]);
    }

    public function actionSwap(int $id)
    {
        $this->service->editStatus($id);
        return $this->redirect(['admin/articles']);
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        try {
            $this->service->remove($id);
            return $this->redirect(['admin/articles']);
        } catch (DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function getViewPath()
    {
        return "@app/views/backend/article";
    }
}
