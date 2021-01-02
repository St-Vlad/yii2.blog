<?php

namespace app\blog\forms\frontend;

use yii\base\Model;

class TagSearchForm extends Model
{
    public ?string $slug = '';

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            ['slug', 'filter', 'filter' => 'trim'],
            ['slug', 'match', 'pattern' => '/^[\w]+$/ui'],
        ];
    }
}
