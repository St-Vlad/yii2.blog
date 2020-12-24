<?php

namespace app\blog\repositories;

use app\blog\entities\Categorie;

class CategoryRepository
{
    public function find($id): ?Categorie
    {
        return Categorie::findOne($id);
    }

    public function save(Categorie $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    public function remove($id): void
    {
        $category = $this->find($id);
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
