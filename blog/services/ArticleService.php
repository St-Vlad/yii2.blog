<?php

namespace app\blog\services;

use app\blog\repositories\ArticleRepository;

class ArticleService
{
    private ArticleRepository $users;

    public function __construct(ArticleRepository $users)
    {
        $this->users = $users;
    }
}
