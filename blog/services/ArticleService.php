<?php

namespace app\blog\services;

use app\blog\entities\Article;
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

    public function edit($id, $form): void
    {
        $article = $this->getArticle($id);
        $article->edit(
            $form->category_id,
            $form->title,
            $form->preview,
            $form->description,
            $form->text
        );
        $this->repository->save($article);
    }

    public function editStatus($id): void
    {
        $article = $this->getArticle($id);
        $article->swapStatus($article);
        $this->repository->save($article);
    }

    public function remove($id): void
    {
        $article = $this->getArticle($id);
        $this->repository->remove($article);
    }

    private function getArticle($id)
    {
        return $this->repository->get($id);
    }
}
