<?php

namespace app\blog\services\blog;

use app\blog\entities\Article;
use app\blog\entities\Tag;
use app\blog\repositories\ArticleRepository;
use app\blog\repositories\TagRepository;
use app\blog\repositories\readRepos\TagRepository as ReadTagRepository;

class ArticleService
{
    private ArticleRepository $articleRepository;
    private TagRepository $tagRepository;
    private ReadTagRepository $readTagRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        TagRepository $tagRepository,
        ReadTagRepository $readTagRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
        $this->readTagRepository = $readTagRepository;
    }

    public function create($form)
    {
        $article = Article::create(
            \Yii::$app->user->id,
            $form->category_id,
            $form->title,
            $form->preview,
            $form->description,
            $form->text
        );
        $this->transact($article, $form->tags);
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
        $this->revokeTags($article);
        $this->transact($article, $form->tags);
    }

    public function editStatus($id): void
    {
        $article = $this->getArticle($id);
        $article->swapStatus($article);
        $this->articleRepository->save($article);
    }

    public function remove($id): void
    {
        $article = $this->getArticle($id);
        $this->articleRepository->remove($article);
    }

    private function revokeTags($article)
    {
        if ($relatedTags = $this->tagRepository->findAllByArticle($article)) {
            foreach ($relatedTags as $tag) {
                $tag->unlink('article', $article, true);
            }
        }
    }

    private function transact($article, $tags)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $this->articleRepository->save($article);

            if (is_array($tags)) {
                $this->assignTags($article, $tags);
            }
            $transaction->commit();
        } catch (\Exception $ex) {
            $transaction->rollBack();
            throw $ex;
        }
    }

    private function assignTags($article, $tags)
    {
        foreach ($tags as $value) {
            if (!$tag = $this->readTagRepository->findByName($value)) {
                $tag = Tag::create($value);
                $this->tagRepository->save($tag);
            }
            $tag->link('article', $article);
        }
    }

    private function getArticle($id): Article
    {
        return $this->articleRepository->get($id);
    }
}
