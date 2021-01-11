<?php

use yii\db\Migration;

/**
 * Class m210111_090931_remove_slug_from_tags
 */
class m210111_090931_remove_slug_from_tags extends Migration
{
    public function up()
    {
        $this->dropIndex('slug', 'tags');
        $this->dropColumn('tags', 'slug');
    }

    public function down()
    {
        $this->addColumn(
            'tags',
            'slug',
            $this->string(50)->notNull()->unique()->after('tag_name')
        );
    }
}
