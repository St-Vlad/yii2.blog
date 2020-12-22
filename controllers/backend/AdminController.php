<?php

namespace app\controllers\backend;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller
{
    public $layout = '@app/views/backend/layouts/main.php';
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
        return '@app/views/backend';
    }
}
