<?php

namespace app\blog\forms\frontend;

use yii\base\Model;

class TagForm extends Model
{
    public ?string $title = '';

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            ['title', 'filter', 'filter' => 'trim'],
            ['title', 'match', 'pattern' => '#^[\w]+$#'],
        ];
    }
}
