<?php

namespace app\blog\services;

class ArticleService
{
    private UserRepository $users;

    public function __construct(ArticleRepository $users)
    {
        $this->users = $users;
    }
}