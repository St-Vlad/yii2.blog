<?php

use yii\db\Migration;

/**
 * Class m201231_142322_change_column_names_for_categories_and_tags
 */
class m201231_142322_change_column_names_for_categories_and_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->renameColumn(
            'tags',
            'name',
            'tag_name'
        );

        $this->renameColumn(
            'categories',
            'name',
            'category_name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->renameColumn(
            'tags',
            'tag_name',
            'name'
        );

        $this->renameColumn(
            'categories',
            'category_name',
            'name'
        );
    }
}
