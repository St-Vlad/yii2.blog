<?php

use yii\db\Migration;

/**
 * Class m201227_100233_add_slug_column_to_articles
 */
class m201227_100233_add_slug_column_to_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('articles', 'slug', $this->string()->notNull()->after('title'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('articles', 'slug');
        return false;
    }
}
