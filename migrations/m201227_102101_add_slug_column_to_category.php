<?php

use yii\db\Migration;

/**
 * Class m201227_102101_add_slug_column_to_category
 */
class m201227_102101_add_slug_column_to_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('categories', 'slug', $this->string()->notNull()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('categories', 'slug');
        return false;
    }
}
