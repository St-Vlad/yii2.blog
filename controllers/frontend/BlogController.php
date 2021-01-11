<?php

namespace app\controllers\frontend;

use app\blog\forms\frontend\TagSearchForm;
use app\blog\repositories\readRepos\ArticleRepository;
use app\blog\repositories\readRepos\CategoryRepository;
use app\blog\repositories\readRepos\TagRepository;
use yii\helpers\Inflector;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

class BlogController extends Controller
{
    private ArticleRepository $articleRepository;
    private CategoryRepository $categoryRepository;
    private TagRepository $tagRepository;

    public $layout = '@app/views/frontend/layouts/main.php';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function __construct(
        $id,
        $module,
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function actionIndex()
    {
        $tagForm = new TagSearchForm();
        $dataProvider = $this->articleRepository->findAllActive();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'tagForm' => $tagForm,
        ]);
    }

    public function actionCategory($slug)
    {
        $tagForm = new TagSearchForm();
        if (!$category = $this->categoryRepository->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->articleRepository->findAllByCategory($category);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'tagForm' => $tagForm,
        ]);
    }

    public function actionArticle($slug)
    {
        if (!$model = $this->articleRepository->findBySlug($slug)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('detailView', [
            'model' => $model,
        ]);
    }

    public function actionTag($tag_name)
    {
        $tagForm = new TagSearchForm();
        if (!$tag = $this->tagRepository->findByName($tag_name)) {
            throw new NotFoundHttpException('Tag does not exist: ' . $tag_name);
        }
        $dataProvider = $this->articleRepository->findAllByTag($tag);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'tagForm' => $tagForm,
        ]);
    }

    public function getViewPath()
    {
        return '@app/views/frontend';
    }
}
