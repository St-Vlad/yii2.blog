<?php

namespace app\blog\forms\frontend\cabinet;

use yii\base\Model;

class ArticleSearch extends Model
{
    public $status;

    public function rules()
    {
        return [
            ['status', 'integer'],
        ];
    }
}
