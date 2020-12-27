<?php

namespace app\blog\services;

use app\blog\entities\Article;
use app\blog\forms\frontend\cabinet\ArticleUpdate;
use app\blog\repositories\ArticleRepository;

class ArticleService
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($form)
    {
        $user = Article::create(
            \Yii::$app->user->id,
            $form->category_id,
            $form->title,
            $form->preview,
            $form->description,
            $form->text
        );
        $this->repository->save($user);
    }

    public function edit($id, ArticleUpdate $form): void
    {
        $article = $this->repository->find($id);
        $article->edit(
            $form->category_id,
            $form->title,
            $form->preview,
            $form->description,
            $form->text
        );
        $this->repository->save($article);
    }
}
