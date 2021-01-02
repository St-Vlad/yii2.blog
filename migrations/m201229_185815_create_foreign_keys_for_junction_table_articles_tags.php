<?php

use yii\db\Migration;

/**
 * Class m201229_185815_create_foreign_keys_for_junction_table_articles_tags
 */
class m201229_185815_create_foreign_keys_for_junction_table_articles_tags extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            '{{%fk-articles-articles_tags}}',
            '{{%articles_tags}}',
            'article_id',
            '{{%articles}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk-tags-articles_tags}}',
            '{{%articles_tags}}',
            'tag_id',
            '{{%tags}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-articles-articles_tags}}', '{{%articles_tags}}');

        $this->dropForeignKey('{{%fk-tags-articles_tags}}', '{{%articles_tags}}');
    }
}
