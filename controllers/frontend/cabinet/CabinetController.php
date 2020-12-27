<?php

namespace app\controllers\frontend\cabinet;

use app\blog\forms\frontend\cabinet\ArticleSearch;
use app\blog\repositories\readRepos\ArticleRepository;
use yii\web\Controller;

class CabinetController extends Controller
{
    private ArticleRepository $articles;

    public $layout = '@app/views/frontend/layouts/main.php';

    public function __construct($id, $module, ArticleRepository $articles, $config = [])
    {
        $this->articles = $articles;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $form = new ArticleSearch();
        $form->load(\Yii::$app->request->queryParams);

        $dataProvider = $this->articles->search($form);
        return $this->render('index', [
            'searchForm' => $form,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEdit()
    {
        $form = new ArticleSearch();
        $form->load(\Yii::$app->request->queryParams);

        $dataProvider = $this->articles->search($form);
        return $this->render('index', [
            'searchForm' => $form,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete()
    {
        $form = new ArticleSearch();
        $form->load(\Yii::$app->request->queryParams);

        $dataProvider = $this->articles->search($form);
        return $this->render('index', [
            'searchForm' => $form,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function getViewPath()
    {
        return '@app/views/frontend/cabinet';
    }
}
