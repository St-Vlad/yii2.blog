<?php

namespace app\blog\forms\backend\update;

use app\blog\entities\Tag;
use yii\base\Model;

class TagUpdate extends Model
{
    public string $tag_name;

    public function __construct(Tag $tag, $config = [])
    {
        $this->tag_name = $tag->tag_name;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['tag_name'], 'filter', 'filter' => 'trim'],
            [['tag_name'], 'required'],
            [['tag_name'], 'string', 'max' => 50],
            [['tag_name'], 'match', 'pattern' => '#^[\w]+$#', 'message' => 'Tags should be mono-words'],
            [['tag_name'], 'unique', 'targetClass' => Tag::class, 'message' => 'Tag name already taken'],
        ];
    }
}
