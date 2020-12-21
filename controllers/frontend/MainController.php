<?php

namespace app\controllers\frontend;

use yii\web\Controller;

/**
 * Default controller for the `main` module
 */
class MainController extends Controller
{
    private ArticleService $service;
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function __construct($id, $module, ArticleService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function getViewPath()
    {
        return '@app/views/frontend';
    }
}
