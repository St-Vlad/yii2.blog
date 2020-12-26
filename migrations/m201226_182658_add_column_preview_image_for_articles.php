<?php

use yii\db\Migration;

/**
 * Class m201226_182658_add_column_preview_image_for_articles
 */
class m201226_182658_add_column_preview_image_for_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('articles', 'preview', $this->string()->notNull()->after('title'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('articles', 'preview');
        return false;
    }
}
