<?php

use yii\db\Migration;

/**
 * Class m201230_081400_add_column_slug_for_tags
 */
class m201230_081400_add_column_slug_for_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn(
            'tags',
            'slug',
            $this->string(50)->notNull()->unique()->after('name')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('tags', 'slug');
    }
}
