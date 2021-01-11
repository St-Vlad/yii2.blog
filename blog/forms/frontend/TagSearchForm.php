<?php

namespace app\blog\forms\frontend;

use yii\base\Model;

class TagSearchForm extends Model
{
    public ?string $tag_name = '';

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            ['tag_name', 'filter', 'filter' => 'trim'],
            ['tag_name', 'match', 'pattern' => '#^[А-Яа-я\w]+$#ui'],
        ];
    }
}
