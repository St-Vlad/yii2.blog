<?php

namespace app\controllers\frontend;

use app\blog\forms\frontend\SignupForm;
use app\blog\services\SignupService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SignupController extends Controller
{
    public $layout = '@app/views/frontend/layouts/main.php';

    private SignupService $service;

    public function __construct($id, $module, SignupService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $this->service->signup($model);
                return $this->goBack();
            } catch (\RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $model->password = '';
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function getViewPath(): string
    {
        return '@app/views/frontend/user/forms';
    }
}
