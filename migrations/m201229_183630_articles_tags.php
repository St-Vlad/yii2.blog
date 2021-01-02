<?php

use yii\db\Migration;

/**
 * Class m201229_183630_articles_tags
 */
class m201229_183630_articles_tags extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';

        $this->createTable('{{%articles_tags}}', [
            'tag_id' => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%articles_tags}}');
    }
}
