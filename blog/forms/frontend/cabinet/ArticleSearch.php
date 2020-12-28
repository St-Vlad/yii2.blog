<?php

namespace app\blog\forms\frontend\cabinet;

use yii\base\Model;

class ArticleSearch extends Model
{
    public ?int $status = null;

    public function rules(): array
    {
        return [
            ['status', 'integer'],
        ];
    }
}
