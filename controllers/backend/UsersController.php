<?php

namespace app\controllers\backend;

use app\blog\forms\backend\update\UserUpdate;
use app\blog\forms\backend\search\UserSearch;
use app\blog\repositories\readRepos\UserRepository as ReadUsersRepository;
use app\blog\repositories\UserRepository;
use app\blog\services\UserManageService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    private ReadUsersRepository $readUsersRepository;
    private UserRepository $usersRepository;
    private UserManageService $service;

    public $layout = '@app/views/backend/layouts/main.php';

    public function __construct(
        $id,
        $module,
        UserManageService $service,
        ReadUsersRepository $readUsersRepository,
        UserRepository $usersRepository,
        $config = []
    ) {
        $this->service = $service;
        $this->readUsersRepository = $readUsersRepository;
        $this->usersRepository = $usersRepository;
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
    {
        try {
            $model = $this->usersRepository->find($id);
        } catch (NotFoundHttpException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError', $e->getMessage());
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user = $this->usersRepository->find($id);
        $updateForm = new UserUpdate($user);

        if ($updateForm->load(Yii::$app->request->post()) && $updateForm->validate()) {
            try {
                $this->service->edit($user->id, $updateForm);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->redirect(['view', 'id' => $user->id]);
        }
        return $this->render('update', [
            'updateForm' => $updateForm,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (NotFoundHttpException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('viewError', $e->getMessage());
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(['admin/users']);
    }

    public function getViewPath()
    {
        return "@app/views/backend/user";
    }
}
